@extends('adminLayout') 

@section('content')
<div class="content-container">
<style>
    .review {
        border: 1px solid #ccc;
        width: 80%;
        margin: 0 auto;
        margin-bottom: 15px;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        background:gainsboro;
    }

    .laptop-info {
        display: flex;
        align-items: center;
    }

    .laptop-image {
        width: 80px;
        height: 80px;
        background-color: #ccc;
        background-size: cover;
        text-align: center;
        line-height: 80px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .laptop-details {
        display: flex;
        flex-direction: column; /* 更改星星和名称的显示方式为纵向排列 */
    }

    .laptop-name {
        font-weight: bold;
    }

    .delete-button {
        background-color: #f00;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .review-body {
        padding: 10px;
    }

    .rating {
        display: flex;
        align-items: center;
    }

    .star {
        color: #FFD700;
        font-size: 24px;
        margin-right: 5px;
    }

    .comment {
        margin-top: 10px;
    }

    .date {
        text-align: right;
        padding: 10px;
        border-top: 1px solid #ccc;
        background:#f8f9fa;
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

    @media screen and (max-width: 767px) {
    .product-grid:hover .add-to-cart {
        bottom: 0;
    }
}
</style>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <h1>Your Review History</h1>

    @if ($reviews !== null && count($reviews) > 0)
        @foreach ($reviews as $index => $review)
            <div class="review col-11" style="padding:0;">
                <div class="review-header">
                    <div class="laptop-info">
                        <div>
                            <a href="{{ route('adminLaptopDetails', ['id' => $review->laptop->id]) }}" class="image">
                            <img src="{{ asset('images/') }}/{{$review->laptop->image}}" class="laptop-image" onclick="event.preventDefault();">
                            </a>
                        </div>
                        <div class="laptop-details">
                            <div class="laptop-name">{{ $review->laptop->manufacturer }} {{ $review->laptop->name }}</div>
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <span class="star">&#9733;</span>
                                    @else
                                        <span class="star">&#9734;</span>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div>
                    <form method="POST" action="{{ route('reviews.delete', ['id' => $review->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-button" onclick="confirmDelete({{ $review->id }}, event)">X</button>

                    </form>
                    </div>
                </div>
                <div class="review-body">
                    <div class="comment">
                        {{ $review->comment }}
                    </div>
                </div>
                <div class="date">
                    On {{ $review->created_at->format('l jS, F Y h:i:s A') }}
                </div>
            </div>
        @endforeach
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
