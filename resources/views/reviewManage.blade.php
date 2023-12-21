
@extends('adminLayout') 

@section('content')
<div class="content-container">
<style>
    .review-table {
        border: 1px solid #ccc;
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse; /* 合并单元格边框 */
    }

    .review-table th, .review-table td {
        margin-top: 25px;
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc; /* 添加单元格边框 */
    }
    .laptop-image {
        width: 100px;
        height: 100px;
        background-color: #ccc;
        background-size: cover;
        text-align: center;
        line-height: 80px;
        margin-right: 10px;
    }

    .product-image {
        text-align: left;
    }

    .star {
        color: #FFD700; /* 设置星星颜色为金黄色 */
        font-size: 24px; /* 调整星星大小 */
    }

    .center-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    }

    .pagination-container{
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .noinformation {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    }
    .no-text {
    text-align: center;
    font-size: 36px; /* 调整文本大小为你想要的大小 */
    }
</style>

<div class="content-container">
    <div class="center-content">
        <h1>Your Review History</h1>
        <form method="GET" action="{{ route('reviewManage.search') }}">
            <input type="text" name="keyword" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>

    @if ($reviews !== null && count($reviews) > 0)
        <table class="review-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th class="vertical-separator">Comment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $index => $review)
                    <tr>
                        <td>{{ ($reviews->currentPage() - 1) * $reviews->perPage() + $index + 1 }}</td>
                        <td class="product-image">
                            @if (!is_null($review->laptop->image))
                            <a href="{{ route('adminLaptopDetails', ['id' => $review->laptop->id]) }}" class="image">
                            <img src="{{ asset('images/') }}/{{$review->laptop->image}}" class="laptop-image">
                            </a>
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $review->laptop->manufacturer }} {{ $review->laptop->name }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <span class="star">&#9733;</span>
                                @else
                                    <span class="star">&#9734;</span>
                                @endif
                            @endfor
                        </td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->created_at }}</td>
                        <td><form method="POST" action="{{ route('adminReviews.delete', ['id' => $review->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-button" onclick="confirmDelete({{ $review->id }}, event)">X</button>

                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{$reviews->links()}}
        </div>

    @else
    <div class="noinformation">
        <h5 class="no-text">No reviews found.</h5>
    </div>  
    @endif
</div>

<script>
    function confirmDelete(reviewId, e) {
    e.preventDefault();
    if (confirm('Are you sure to delete?')) {
        // 发送 DELETE 请求到服务器
        fetch(`/adminReviews/${reviewId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // 显示消息
            alert(data.message);
            // 可以刷新页面或者执行其他操作
            location.reload();
        })
        .catch(error => {
            // 处理错误情况
            console.error('Error:', error);
        });
    }
}

</script>   
@endsection