<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use APP\Models\laptop;
use DB;

class ReviewController extends Controller
{
    public function saveReview(Request $request)
    {
        $this->validate($request, [
            'user_review' => 'required|min:5', // 评论字段必填，最小长度为10个字符
            'laptop_id' => 'required|numeric', // 笔记本电脑ID必填且为数字
            'rating_data' => 'required|integer|min:1|max:5', // 评分必填，为整数，范围在1到5之间
        ]);

        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $user_review = $request->input('user_review');
            $laptop_id = $request->input('laptop_id');
            $rating_data = $request->input('rating_data');

            if (empty($user_review) || empty($laptop_id)) {
                return response()->json(['message' => 'Please Fill All Fields'], 400);
            }

            $review = Review::create([
                'user_id' => $user_id,
                'laptop_id' => $laptop_id,
                'comment' => $user_review,
                'rating' => $rating_data,
            ]);

            return response()->json(['message' => 'Your Review & Rating Successfully Submitted', 'review' => $review->toArray()], 200);
        } else {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    }


    public function loadRatingData(Request $request)
    {
        // 获取评分和评论数据，可以从数据库或其他数据源中检索数据
        $reviews = Review::where('laptop_id', $request->input('laptopId'))->get();

        // 将数据格式化为JSON
        $data = [];
        foreach ($reviews as $review) {
            $data[] = [
                'user_id' => $review->user_id, 
                'laptop_id' => $review->laptop_id, 
                'rating' => $review->rating,
                'user_review' => $review->comment,
            ];
        }
        // 返回数据作为JSON响应
        return response()->json($data);
    }

    public function loadReviewData(Request $request)
    {
        $laptopId = $request->input('laptopId');
        // 在这里添加你之前提供的评论和评分数据处理逻辑
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();

        $reviews = Review::where('laptop_id', $laptopId)->get();
        
        foreach ($reviews as $review) {
            $review_content[] = [
                'id' => $review->id,
                'user_name' => $review->user->name,
                'user_review' => $review->comment,
                'rating' => $review->rating,
                'datetime' => $review->created_at->format('l jS, F Y h:i:s A'),
            ];

            switch ($review->rating) {
                case 5:
                    $five_star_review++;
                    break;
                case 4:
                    $four_star_review++;
                    break;
                case 3:
                    $three_star_review++;
                    break;
                case 2:
                    $two_star_review++;
                    break;
                case 1:
                    $one_star_review++;
                    break;
            }

            $total_review++;
            $total_user_rating += $review->rating;
        }

        $average_rating = $total_user_rating / $total_review;

        $output = [
            'average_rating' => number_format($average_rating, 1),
            'total_review' => $total_review,
            'five_star_review' => $five_star_review,
            'four_star_review' => $four_star_review,
            'three_star_review' => $three_star_review,
            'two_star_review' => $two_star_review,
            'one_star_review' => $one_star_review,
            'review_data' => $review_content,
        ];

        return response()->json($output);
    }

    public function reviewHistory()
    {
        $userId = auth()->user()->id;
        
        // 查询用户的收藏数据，同时获取与之关联的 laptop 数据
        $reviews = Review::where('user_id', $userId)->with('laptop')->paginate(10);

        // 如果第一页不满10个评论，且不是最后一页，手动调整第二页的评论
        if ($reviews->currentPage() == 1 && $reviews->count() < 10 && !$reviews->lastPage()) {
            // 获取第一页的评论数量
            $firstPageCount = $reviews->count();

            // 查询第二页的评论，从第11个评论开始
            $remainingReviews = Review::where('user_id', $userId)
                ->with('laptop')
                ->skip($firstPageCount)
                ->take(10 - $firstPageCount) // 获取缺少的评论数量
                ->get();

            // 将第一页和第二页的评论合并
            $reviews = $reviews->merge($remainingReviews);
        }
        return view('reviewHistory', ['reviews' => $reviews]);
    }

    public function adminReviewHistory()
    {
        $userId = auth()->user()->id;
        
        // 查询用户的收藏数据，同时获取与之关联的 laptop 数据
        $reviews = Review::where('user_id', $userId)->with('laptop')->get();

        return view('adminReviewHistory', ['reviews' => $reviews]);
    }

    public function reviewManage()
    {
        $perPage = 15; // 每页评论数量
    
        // 获取所有评论，分页显示
        $reviews = Review::simplePaginate($perPage);

    
        return view('reviewManage', ['reviews' => $reviews]);
    }

    public function adminReviewManage($laptopId)
    {
        $reviews = Review::where('laptop_id', $laptopId)->with('laptop')->get();
    
        // 你可以进一步定制你的视图和返回数据，具体根据你的需求来决定
        return view('adminReviewManage', ['reviews' => $reviews]);

    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // 进行模糊搜索，使用评论内容字段
        $reviews = Review::where('comment', 'like', '%' . $keyword . '%')->paginate(15);

        return view('reviewManage', ['reviews' => $reviews]);
    }



    public function deleteReview($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // Check if the user is authorized to delete the review, e.g., by checking if the review belongs to the currently logged-in user.
        if ($review->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized to delete this review'], 403);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }

    public function adminDeleteReview($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }

    public function editReview(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // Check if the user is authorized to edit the review, e.g., by checking if the review belongs to the currently logged-in user.
        if ($review->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized to edit this review'], 403);
        }

        $this->validate($request, [
            'user_review' => 'required|min:5', // 评论字段必填，最小长度为5个字符
            'rating_data' => 'required|integer|min:1|max:5', // 评分必填，为整数，范围在1到5之间
        ]);

        $user_review = $request->input('user_review');
        $rating_data = $request->input('rating_data');

        $review->comment = $user_review;
        $review->rating = $rating_data;
        $review->save();

        return response()->json(['message' => 'Review updated successfully', 'review' => $review]);
    }

    public function updateReview(Request $request, $id)
{
    $review = Review::find($id);

    if (!$review) {
        return response()->json(['message' => 'Review not found'], 404);
    }

    // Check if the user is authorized to edit the review
    if ($review->user_id !== auth()->user()->id) {
        return response()->json(['message' => 'Unauthorized to edit this review'], 403);
    }

    $this->validate($request, [
        'user_review' => 'required|min:5',
        'rating_data' => 'required|integer|min:1|max:5',
    ]);

    $user_review = $request->input('user_review');
    $rating_data = $request->input('rating_data');

    $review->comment = $user_review;
    $review->rating = $rating_data;
    $review->save();

    return response()->json(['message' => 'Review updated successfully', 'review' => $review]);
}
}
