
@extends('adminLayout') 

@section('content')

<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<div class="content-container">
<style>
    .review-table {
        border: 1px solid #ccc;
        width: 90%;
        margin: 0 auto;
        border-collapse: collapse; /* 合并单元格边框 */
        word-wrap: break-word; 
    }

    .review-table th, .review-table td {
        margin-top: 25px;
        padding: 10px;
        text-align: center;
        width: 100px;
        height: 50px;
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
    
    .sort{
        background: black;
        color: white;
        height: 70px;
    }

    .delete-button img {
    width: 50px; /* 适当的图像宽度 */
    height: 50px; /* 适当的图像高度 */
    }
/**if no information */
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
.review-table {
    width: 100%;
    table-layout: fixed;
    max-width: 100%; /* 添加 max-width 属性 */
    overflow-x: auto; 
}

.review-table th, .review-table td {
    font-size: 7px; /* 调整字体大小 */
    word-wrap: break-word;
    max-width: 200px;
}

.review-table th, .review-table td {
    height: auto;
    padding: 5px;
    width: 100%;
}

.sort {
    height: auto;
}

.review-table {
    overflow-x: auto;
}

.delete-button {
    width: 30px; /* 适当的按钮宽度 */
    height: 30px; /* 适当的按钮高度 */
}
.delete-button img {
    width: 20px; /* 适当的图像宽度 */
    height: 20px; /* 适当的图像高度 */
}
h1 {
    font-size: 2.0rem;
}
.center-content form {
    max-width: 60%; /* 或者适当的百分比值，根据需要调整 */
    margin: 0 auto; /* 居中显示 */
}

.center-content form input,
.center-content form select,
.center-content form button {
    width: 80%; /* 使输入框、选择框和按钮占满父容器宽度 */
    margin-bottom: 10px; /* 添加一些底部间距，以避免太靠近 */
}

}

    


</style>

<div class="content-container">
    <div class="center-content col-12">
        <h1>Feedback Manage</h1>
            <form method="GET" action="{{ route('feedbackManage.search') }}">
                <input type="text" name="keyword" placeholder="Search...">
                <select id="feedbackTypeSelect" name="feedback_type">
                    <option value="all">All type</option>
                    <option value="General">General Feedback</option>
                    <option value="Bug Report">Bug Report</option>
                    <option value="Feature Request">Feature Request</option>
                </select>
                <button type="submit">Search</button>
            </form>
    </div>
    </br>
    @if ($feedbacks !== null)
        <table class="review-table">
            <thead class="sort">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th class="vertical-separator">Comment</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $loop->iteration + ($feedbacks->perPage() * ($feedbacks->currentPage() - 1)) }}</td>
                        <td>{{ $feedback->name }} </td>
                        <td>{{ $feedback->email }} </td>
                        <td>{{$feedback->feedback_type}}</td>
                        <td>{{ $feedback->message}}</td>
                        <td><img src="{{ asset('images/' . $feedback->image) }}" alt="Feedback Image"></td>
                        <td>{{ $feedback->created_at }}</td>
                        <td>
                            <form method="POST" action="{{ route('feedback.delete', ['id' => $feedback->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" onclick="confirmDelete({{ $feedback->id }}, event)"><img src="{{ asset('images/deleteLogo.png') }}" class="delete-icon"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{$feedbacks->links()}}
        </div>

    @else
    <div class="noinformation">
        <h5 class="no-text">No feedback found.</h5>
    </div>  
    @endif
</div>

<script>
    function confirmDelete(feedbackId, e) {
    e.preventDefault();
    if (confirm('Are you sure to delete?')) {
        // 发送 DELETE 请求到服务器
        fetch(`/feedback/${feedbackId}`, {
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

    function refreshFeedbackList(feedbackType) {
    window.location.href = "{{ route('feedbackManage.show') }}?feedback_type=" + feedbackType;
    }

    let selectedType = 'all';

    document.getElementById('feedbackTypeSelect').addEventListener('change', function() {
        selectedType = this.value;
    });

    
</script>   
@endsection