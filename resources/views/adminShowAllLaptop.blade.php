@extends('adminLayout')
@section('content')

<style>
/*brand */
.title{
    display: flex;
  align-items: center;
  justify-content: center;
}

/*card */    
.col-md-3{
  
  padding-top:12px;
}
.product-grid{
    font-family: 'Poppins', sans-serif;
    text-align: center;
}
.product-grid .product-image{
    height: 250px;
    overflow: hidden;
    position: relative;
    z-index: 1;
}
.product-grid .product-image a.image{display: block; }
.product-grid .product-image img{
    width: 100%;
    height: auto;
}
.product-grid .product-discount-label{
    color: #fff;
    background: #A5BA8D;
    font-size: 13px;
    font-weight: 600;
    line-height: 25px;
    padding: 0 20px;
    position: absolute;
    top: 10px;
    left: 0;
}
.product-grid .product-links{
    padding: 0;
    margin: 0;
    list-style: none;
    position: absolute;
    top: 10px;
    right: -50px;
    transition: all .5s ease 0s;
}
.product-grid:hover .product-links{ right: 10px; }
.product-grid .product-links li a{
    color: #333;
    background: transparent;
    font-size: 17px;
    line-height: 38px;
    width: 38px;
    height: 38px;
    border: 1px solid #333;
    border-bottom: none;
    display: block;
    transition: all 0.3s;
}
.product-grid .product-links li:last-child a{ border-bottom: 1px solid #333; }
.product-grid .product-links li a:hover{
    color: #fff;
    background: #333;
}
.product-grid .add-to-cart{
    background: #A5BA8D;
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 2px;
    width: 100%;
    padding: 10px 26px;
    position: absolute;
    left: 0;
    bottom: -60px;
    transition: all 0.3s ease 0s;
}
.product-grid:hover .add-to-cart{ bottom: 0; }
.product-grid .add-to-cart:hover{ text-shadow: 4px 4px rgba(0,0,0,0.2); }
.product-grid .product-content{
    background: #fff;
    padding: 15px;
    box-shadow: 0 0 0 5px rgba(0,0,0,0.1) inset;
    height: 140px;
    overflow: hidden;
}
.product-grid .title{
    font-size: 16px;
    font-weight: 600;
    text-transform: capitalize;
    margin: 0 0 7px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.product-grid .title a{
    color: #777;
    transition: all 0.3s ease 0s;
}
.product-grid .title a:hover{ color: #a5ba8d; }
.product-grid .price{
    color: #0d0d0d;
    font-size: 14px;
    font-weight: 600;
}
.product-grid .h4{
    color: black;
    font-size: 15px;
    text-align: center;
}
.product-grid .memory{
   color: #9aa7af;
    display: block;
    font-size: 13px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.product-grid .price span{
    color: #888;
    font-size: 13px;
    font-weight: 400;
    text-decoration: line-through;
}
@media screen and (max-width: 767px) {
    .manu_title {
        font-size: 2em;
    }

    .col-md-3 .col-sm-3{
        width: 50%;
    }

    .product-grid {
        padding: 3px;
    }

    .product-content {
        height: auto;
    }    
    .product-grid .product-image {
        height: 120px;
    }
    .product-grid .product-links {
        top:1px;
    }
    .product-grid:hover .product-links {
        right: 0px;
    }
    .product-grid .add-to-cart {
        font-size: 12px;
        letter-spacing: 2px;
        padding: 1px 5px;
    }
    .favorite-button {
        line-height: 30px;
        width: 30px;
        height: 30px;
    }
    .product-grid .product-links li a {
        line-height: 30px;
        width: 30px;
        height: 30px;
    }

    .product-grid .product-content {
        padding: 7px;
        height: 130px;
    }
    .product-grid .title {
        font-size: 13px;
        font-weight: 600;
    }
    .product-grid .memory {
        font-size: 11px;
    }
}    
</style>

<div class="row">
    <div class="col-md-12">
        <h3 class="title">Results for "{{$keyword}}"</h3>
    </div>
    <div class="row">
    @foreach ($laptops as $laptop)
          <div class="col-md-3 col-6">
            <div class="product-grid">
              <div class="product-image">
                <a href="{{ route('adminLaptopDetails', ['id' => $laptop->id]) }}" class="image">
                    <img src="{{ asset('images/') }}/{{$laptop->image}}" onclick="event.preventDefault();">
                </a>
                
                <ul class="product-links">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="{{ route('adminCompareLaptop', ['id' => $laptop->id]) }}"><img src="{{ asset('images/compare logo.jpg') }}"></a></li>
                </ul>
                <a href="{{ route('adminLaptopDetails', ['id' => $laptop->id]) }}" class="add-to-cart">View laptop</a>
              </div>

              <div class="product-content">
                  <h4 class="title"><a href="#">{{$laptop->manufacturer}} {{ $laptop->name }} {{$laptop->process_model}}</a></h4>
                  <div class="memory">{{$laptop->screen_size}} {{$laptop->memory}}{{$laptop->storage}}</div>
                  <div class="price">RM{{ $laptop->price}}</div>
              </div>
            </div>
          </div>
       
    @endforeach
    </div>
</div>
<div class="content">
@endsection