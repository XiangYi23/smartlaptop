<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\feedback;

class FeedbackController extends Controller
{
    public function create()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return view('userFeedback');
        }
        return redirect()->route('login', ['id' => $user->id]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'feedback_type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
            $validatedData['image'] = $imageData;
        
            // 将图像保存到服务器，例如：public/images 目录
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('images/' . $imageName);
            file_put_contents($imagePath, $imageData);
        
            // 更新 $validatedData['image'] 为图像文件名或路径
            $validatedData['image'] = $imageName;
        }
        // 关联反馈到用户
        $feedback = $user->feedback()->create($validatedData);

        if ($feedback) {
            return redirect()->route('feedback.create', ['id' => auth()->user()->id])->with('success', 'Feedback submitted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to submit feedback.');
        }
    }

    public function feedbackManage()
    {
        $feedbacks = Feedback::simplePaginate(15);

    
        return view('feedbackManage', compact('feedbacks'));
    }

    public function showFeedbackByType(Request $request)
    {
        $selectedFeedbackType = $request->input('feedback_type', 'all'); // 默认为 All 类型

        $query = Feedback::query();

        if ($selectedFeedbackType !== 'all') {
            $query->where('feedback_type', $selectedFeedbackType);
        }
        
        $feedbacks = $query->simplePaginate(15);

        return view('feedbackManage', compact('feedbacks'));
    }

    public function deleteFeedback($id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json(['message' => 'Feedback not found'], 404);
        }

        $feedback->delete();

        return response()->json(['message' => 'Feedback deleted successfully']);
    }
   
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $feedbackType = $request->input('feedback_type');

        $query = Feedback::query();

        if ($feedbackType !== 'all') {
            $query->where('feedback_type', $feedbackType);
        }

        if (!empty($keyword)) {
            $query->where('message', 'like', '%' . $keyword . '%');
        }

        $feedbacks = $query->simplePaginate(15);

        return view('feedbackManage', ['feedbacks' => $feedbacks]);
    }

    
}
