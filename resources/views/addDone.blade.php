@extends('adminLayout')
@section('content')
<style>
.container{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
   height: 50vh;
}  
</style>

<div class="row">
  <div class="container"> 
  <div class="col-md-12">
    
      <div class="alert alert-success">
        <strong>✔</strong> Successfully added product!</br>
        <h6>Total Number of Laptops: {{ $laptopCount }}</h6>
      </div>
      <div class="col-md-12">
        <a href="{{ url('add') }}"><h6> Back to Add Product page</h6></a> </br>
        <a href="{{ url('/adminPage/store') }}"><h6> Back to main page</h6></a>
      </div>  
    </div>
  </div>
</div>
@endsection