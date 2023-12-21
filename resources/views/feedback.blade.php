@extends('layout')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  outline: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  min-height: 100vh;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(115deg, #56d8e4 10%, #9f01ea 90%);
}
.container{
  align-items: center;
  justify-content: center;
  max-width: 800px;
  background: #fff;
  width: 800px;
  padding: 25px 40px 10px 40px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
.container .message{
  text-align: center;
  font-size: 50px;
  font-weight: 700;
  
}
.container .text{
  text-align: center;
  font-size: 41px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.container form{
  padding: 30px 0 0 0;
}
.container form .form-row{
  display: flex;
  margin: 32px 0;
}
form .form-row .input-data{
  width: 100%;
  height: 40px;
  margin: 0 20px;
  position: relative;
}
form .form-row .textarea{
  height: 70px;
}
.input-data input,
.textarea textarea{
  display: block;
  width: 100%;
  height: 100%;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid rgba(0,0,0, 0.12);
}
.input-data input:focus ~ label, .textarea textarea:focus ~ label,
.input-data input:valid ~ label, .textarea textarea:valid ~ label{
  transform: translateY(-20px);
  font-size: 14px;
  color: #3498db;
}
.textarea textarea{
  resize: none;
  padding-top: 10px;
}
.input-data label{
  position: absolute;
  pointer-events: none;
  bottom: 10px;
  font-size: 16px;
  transition: all 0.3s ease;
}
.textarea label{
  width: 100%;
  bottom: 40px;
  background: #fff;
}
.input-data .underline{
  position: absolute;
  bottom: 0;
  height: 2px;
  width: 100%;
}
.input-data .underline:before{
  position: absolute;
  content: "";
  height: 2px;
  width: 100%;
  background: #3498db;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.3s ease;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before,
.textarea textarea:focus ~ .underline:before,
.textarea textarea:valid ~ .underline:before{
  transform: scale(1);
}
.submit-btn .input-data{
  overflow: hidden;
  height: 45px!important;
  width: 25%!important;
}
.submit-btn .input-data .inner{
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
  transition: all 0.4s;
}
.submit-btn .input-data:hover .inner{
  left: 0;
}
.submit-btn .input-data input{
  background: none;
  border: none;
  color: #fff;
  font-size: 17px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
  position: relative;
  z-index: 2;
}
@media (max-width: 700px) {
  .container .text{
    font-size: 30px;
  }
  .container form{
    padding: 10px 0 0 0;
  }
  .container form .form-row{
    display: block;
  }
  form .form-row .input-data{
    margin: 35px 0!important;
  }
  .submit-btn .input-data{
    width: 40%!important;
  }
}

.input-data input.active ~ label {
    transform: translateY(-20px);
    font-size: 14px;
    color: #3498db;
}

.input-data input.active {
    border-bottom: 2px solid #3498db;
    color: black;
}

</style>

<div class="container">
    
    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id="okButton">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <div class="text">
        Contact us Form
    </div>
    @auth <!-- 仅当用户已登录时才显示表单 -->
    <form method="POST" action="{{ route('feedback.store',['id' => auth()->user()->id]) }}">
        @csrf <!-- 添加 CSRF 令牌，以防止跨站请求伪造攻击 -->

        <div class="form-row">
            <div class="input-data">
                <input type="text" name="name" id="name" readonly value="{{ auth()->user()->name }}" autocomplete="off"  class="active">
                <div class ="underline"></div>
                <label for="name">Name</label>
            </div>
        </div>
        <div class="form-row">
            <div class="input-data">
                <input type="email" name="email" id="email" readonly value="{{ auth()->user()->email }}" autocomplete="off"  class="active">
                <div class="underline"></div>
                <label for="email">Email Address</label>
            </div></br>
            <div class="input-data">
            <select name="feedback_type" id="feedback_type" required>
                <option value="General">General Feedback</option>
                <option value="Bug Report">Bug Report</option>
                <option value="Feature Request">Feature Request</option>
            </select>
            </div>
        </div>
        <div class="form-row">
            <div class="input-data textarea">
                <textarea name="message" id="message" rows="8" cols="80" required></textarea>
                <br />
                <div class="underline"></div>
                <label for="message">Write your message</label>
            </div>
        </div>
        <div class="form-row submit-btn">
            <div class="input-data">
                <div class="inner"></div>
                  <input type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
    @endauth <!-- 结束表单的显示条件 -->
</div>

<script>
    // 显示模态框
    $(document).ready(function() {
        $('#successModal').modal('show');
    });
    $('#okButton').click(function() {
            window.location.href = '/home'; // 这里设置主页的URL
        });
</script>
@endsection