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
  background: cyan;
}
.introduce{
  align-items: center;
  justify-content: center;
  text-align: center;
}

.center-container{
  display: flex;
    justify-content: center;
    align-items: center;
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

.feedback {
  font-size: 28px;
  color: royalblue;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
}

.feedback::before,.feedback::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: royalblue;
}

.feedback::before {
  width: 18px;
  height: 18px;
  background-color: royalblue;
}

.feedback::after {
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
  flex-direction: column;
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

</style>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="col-md-12 col-12 center-container">
  @auth
  <form class="form" method="POST" action="{{ route('feedback.store',['id' => auth()->user()->id]) }}" enctype="multipart/form-data"> 
    @csrf
      <p class="feedback">Feedback </p>
      <p class="message" style="font-weight:bolder;">Tell us how we're doing.</p>
      <p class="message" style="font-weight:bolder;">* Indicates required field.</p>
        <div class="flex">
          <label>
              <input type="text" name="name" id="name" readonly value="{{ auth()->user()->name }}" class="form-control">
              <span  style="top: 30px;font-size: 0.7em;font-weight: 600;color: green;">Name</span>
          </label>
          <label>
              <input type="email" name="email" id="email" readonly value="{{ auth()->user()->email }}" class="form-control">
              <span  style="top: 30px;font-size: 0.7em;font-weight: 600;color: green;">Email Address</span>
          </label>

          <label>
              <select name="feedback_type" id="feedback_type" required>
                <option value="General">General Feedback</option>
                <option value="Bug Report">Bug Report</option>
                <option value="Feature Request">Feature Request</option>
              </select>
          </label>

          <label>
            <input name="message" id="message" type="text" rows="8" cols="80" required autocomplete="off" class="form-control">
            <span>Write your message</span>
          </label> 

          <label>
              <input name="image" type="file" class="form-control" placeholder=""  placeholder="">
              
          </label>
        </div>  
      <button class="submit">Submit</button>
  </form>
  @endauth
</div>

      </div>
    </div>

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