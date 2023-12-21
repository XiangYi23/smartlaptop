@extends('adminLayout')
@section('content')
<style>
.center-container{
  display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh; /* This ensures the form is centered vertically on the viewport /
    background-color: #f7f7f7; / Example background color, adjust as needed */
}


.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  
  background-color: #fff;
  padding: 20px;
  border-radius: 20px;
  position: relative;
  justify-content: center;
}

.title {
  font-size: 28px;
  color: royalblue;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
}

.title::before,.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: royalblue;
}

.title::before {
  width: 18px;
  height: 18px;
  background-color: royalblue;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.message, .signin {
  color: rgba(88, 87, 87, 0.822);
  font-size: 14px;
}

.signin {
  text-align: center;
}

.signin a {
  color: royalblue;
}

.signin a:hover {
  text-decoration: underline royalblue;
}

.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  position: relative;
}

.form-select{
  width: 120%;
  padding: 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;

}
.form label .form-control {
  width: 100%; /* 保持输入框宽度为100% */
  padding: 10px; /* 调整内边距 */
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .form-control {
  width: 100%;
  padding: 10px 10px 20px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .form-control + span {
  position: absolute;
  left: 10px;
  top: 15px;
  color: grey;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .form-control:placeholder-shown + span {
  top: 15px;
  font-size: 0.9em;
}

.form label .form-control:focus + span,.form label .form-control:valid + span {
  top: 30px;
  font-size: 0.7em;
  font-weight: 600;
}

.form label .form-control:valid + span {
  color: green;
}

.submit {
  border: none;
  outline: none;
  background-color: royalblue;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
}

.submit:hover {
  background-color: rgb(56, 90, 194);
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}

/**review */
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
</style>


<div class="center-container">
  <div class="col-md-6" style="max-width: 100%; margin-top: 10%;">
  @forelse ($reviews as $review)
            <img src="{{ asset('images/') }}/{{ $review->laptop->image }}" alt="Laptop Image" class="uploaded-image" style="width: 100%; height: auto;">
            <!-- 这里放置评论的其他相关代码 -->
        @empty
            <!-- 如果没有评论，显示默认图片或其他内容 -->
            <img src="{{ asset('images/default.jpg') }}" alt="Default Image" class="uploaded-image" style="width: 100%; height: auto;">
        @endforelse
  </div>


<div class="col-md-6">
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

    <p class="title">Review Manage </p>

    @if ($reviews !== null && count($reviews) > 0)
        @foreach ($reviews as $index => $review)
            <div class="review">
                <div class="review-header">
                    <div class="laptop-info">
                        <div class="rounded-circle bg-danger text-white pt-2 pb-2 laptop-image">
                            <h3 class="text-center">{{$review->user->name[0]}}</h3>
                        </div>
                        <div class="laptop-details">
                            <div class="laptop-name">{{ $review->user->name }}</div>
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

</div>
@endsection