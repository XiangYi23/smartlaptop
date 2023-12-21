@extends('adminLayout')
@section('content')

<style>
/* 共用样式 */
.title {
    color: blue;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 20vh;
    margin-right: 50px;
}

.container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 30px;
}

.img-admin {
    max-width: 230px;
    height: auto;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 50px;
    margin-right: 10px;
}

.img-admin img {
    flex: 1;
}

/* 电脑版本样式 */
.container_table {
    width: 80%;
    margin-left: 150px;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}

/* 手机版本样式 */
@media (max-width: 768px) {
    .container_table {
        width: 100%;
        margin-left: 0;
    }
}
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }
}

/*button */
button {
  display: flex;
  align-items: center;
  justify-content: center;
  outline: none;
  cursor: pointer;
  width: 60px;
  height: 50px;
  background-image: linear-gradient(to top, #D8D9DB 0%, #fff 80%, #FDFDFD 100%);
  border-radius: 30px;
  border: 1px solid #8F9092;
  transition: all 0.2s ease;
  font-family: "Source Sans Pro", sans-serif;
  font-size: 14px;
  font-weight: 600;
  color: #606060;
  text-shadow: 0 1px #fff;
}

button:hover {
  box-shadow: 0 4px 3px 1px #FCFCFC, 0 6px 8px #D6D7D9, 0 -4px 4px #CECFD1, 0 -6px 4px #FEFEFE, inset 0 0 3px 3px #CECFD1;
}

button:active {
  box-shadow: 0 4px 3px 1px #FCFCFC, 0 6px 8px #D6D7D9, 0 -4px 4px #CECFD1, 0 -6px 4px #FEFEFE, inset 0 0 5px 3px #999, inset 0 0 30px #aaa;
}

button:focus {
  box-shadow: 0 4px 3px 1px #FCFCFC, 0 6px 8px #D6D7D9, 0 -4px 4px #CECFD1, 0 -6px 4px #FEFEFE, inset 0 0 5px 3px #999, inset 0 0 30px #aaa;
}



</style>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3 class="title">Admin page</h3>
        
        <div class="col-md-12 col-sm-12" >
            <div class="container">
            <a href="{{ url('add') }}"> <img src="{{ asset('images/Screenshot 2023-08-19 113138.png') }}" class="img-admin" alt=""></a>
            <a href="{{ url('/selectLaptop') }}"> <img src="{{ asset('images/Screenshot 2023-08-19 114150.png') }}" class="img-admin" alt=""></a>
            <a href="{{ url('/feedbackManage') }}"> <img src="{{ asset('images/feedback.PNG') }}" class="img-admin" alt=""></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3 class="title">Recently Add Product</h3>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="container_table">
            <div class="row">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="thead-dark">
                            <th>ID</th>
                            <th>Manufacturer</th>
                            <th>Name</th>
                            <th>image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($laptops->reverse() as $laptop)
                        <tr>
                            <td>{{$laptop->id}}</td>
                            <td>
                                {{$laptop->manufacturer}}
                               
                            </td>
                            <td style="max-width:300px">
                                <h6>{{$laptop->name}}</h6>   
                            </td>
                            <td>
                                <a href="{{ route('adminLaptopDetails', ['id' => $laptop->id]) }}">
                                    <img src="{{ asset('images/') }}/{{$laptop->image}}" width="100" class="img-fluid" alt="">
                                </a>
                            </td>
                            
                            <td>
                            <div style="display: flex; align-items: center;">
                                <a href="{{ route('editLaptop', ['id' => $laptop->id]) }}"><button style="margin-right: 5px; padding: 5px 10px;  background-color: #3498db; color: black;">Edit</button> </a>

                                <a href="{{ route('viewlaptop.delete', ['id' => $laptop->id]) }}"
                                    onClick="return confirm('Are you sure to delete?')"><button style="padding: 5px 10px; background-color: #e74c3c; color: black;">Delete</button> </a>
                            </div>    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection