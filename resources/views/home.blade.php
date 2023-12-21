@extends('layout')
@section('content')
<style>
@import url(https://fonts.googleapis.com/css?family=Signika:700,300,600);

/*category */
.card {
  box-sizing: border-box;
  width: calc(25% - 20px); 
  height: 254px;
  background: rgba(217, 217, 217, 0.58);
  border: 1px solid white;
  box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
  backdrop-filter: blur(6px);
  border-radius: 17px;
  text-align: center;
  cursor: pointer;
  transition: all 0.5s;
  display: flex;
  align-items: center;
  justify-content: center;
  user-select: none;
  font-weight: bolder;
  color: black;
  
}
.img-admin{
    max-width: 100%;
    max-height: 100%;
}
.card:hover {
  border: 1px solid black;
  transform: scale(1.05);
}

.card:active {
  transform: scale(0.95) rotateZ(1.7deg);
}

.title {
    color: blue;
    text-align: center; 
    display: flex;
    justify-content: center; 
    align-items: center; 
    height: 20vh; 
}
.container{
    width: 100%;
    align-items: center;
    justify-content: center;
   
}
.card-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* 使卡片平均分布在每行 */
    gap: 20px; /* 控制卡片之间的间隔 */
}

/*card */    
.cards {
  position: relative;
  width: 300px;
  height: 200px;
  background-color: #f2f2f2;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  perspective: 1000px;
  box-shadow: 0 0 0 5px #ffffff80;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cards svg {
  width: 48px;
  fill: #333;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cards:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}

.cards__content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 20px;
  box-sizing: border-box;
  background-color: #f2f2f2;
  transform: rotateX(-90deg);
  transform-origin: bottom;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cards:hover .cards__content {
  transform: rotateX(0deg);
}

.cards__title {
  margin: 0;
  font-size: 24px;
  color: #333;
  font-weight: 700;
}

.cards:hover svg {
  scale: 0;
}

.cards__description {
  margin: 10px 0 0;
  font-size: 14px;
  color: #777;
  line-height: 1.4;
}
.col-md-3 {
  display: inline-block;
  vertical-align: top;
  justify-content: space-between; /* 使卡片平均分布在每行 */
    gap: 20px;
  /* 可以添加一些间距等样式 */
}
</style>


<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 500px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 35px;
  font-family: "tahoma","Helvetica","sans-serif";
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}

</style>

<style>
  button{
    border: none;
    cursor: pointer;
    color: white;
    background: none;
    transition: all .3s ease-in-out;
}

.container {
  width: 100%;
  height: 65vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: white;
}

.carousel-view {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 10px;
  padding: 44px 0;
  transition: all 0.25s ease-in;
}

.carousel-view .item-list {
  max-width: 950px;
  width: 70vw;
  padding: 50px 660px;
  display: flex;
  gap: 48px;
  scroll-behavior: smooth;
  transition: all 0.25s ease-in;
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
  overflow: auto;
  scroll-snap-type: x mandatory;
}


/* Hide scrollbar for Chrome, Safari and Opera */
.item-list::-webkit-scrollbar {
  display: none;
}

.prev-btn {
  background = none;
  cursor: pointer;
}

.next-btn {
  cursor: pointer;
}

.item {
  scroll-snap-align: center;
  min-width: 480px;
  width:auto;
  height: 500px;
  background-color: grey;
  border-radius:20px;
}
/*copy form APPLE*/ 

.rs-mainheader{
  font-size: 40px;
    line-height: 1.14286;
    font-weight: 600;
    letter-spacing: .007em;
    font-family: SF Pro Display,SF Pro Icons,AOS Icons,Helvetica Neue,Helvetica,Arial,sans-serif;
    color:red;
    display: inline;
}

.rs-subheader{
  font-size: 40px;
    line-height: 1.08349;
    font-weight: 600;
    letter-spacing: -.003em;
    font-family: SF Pro Display,SF Pro Icons,AOS Icons,Helvetica Neue,Helvetica,Arial,sans-serif;
    display: inline;
}
/*copy form APPLE*/ 

/*horizontal scroll img*/
* {
  box-sizing: border-box;
}

body {
  font-family: Arial;
  font-size: 17px;
}

.img-container {
  position: relative;
  max-width: 800px;
  margin: 0 auto;
  border-radius: 49px;
background: #ffffff;
box-shadow:  6px 6px 21px #808080,
             -6px -6px 21px #ffffff;
}

.img-container img {vertical-align: middle;}

.img-container .content {
  position: absolute;
  bottom: 0;
  /background: rgb(0, 0, 0); / Fallback color */
  /background: rgba(0, 0, 0, 0.5); / Black background with 0.5 opacity */
  color: black;
  width: 100%;
  padding: 20px;
}
/*horizontal scroll img*/
.carousel-item{
  background-color: #fff;
}
.carousel-control-prev,
.carousel-control-next{
  color: black;
}
</style>


@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="row">
          <div class="col-sm-3 col-md-3"></div>
        <div class="col-sm-6 col-md-6">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                  <img src="images/Asus ROG Zephyrus Duo 15.jpg" class="d-block mx-auto" alt="..." style="width: 500px !important;height: 500px !important;position: center !important">
                    <div class="product-content" style="color:black; background-color: #fff; text-align: center; font-size:22px"><b>Asus ROG Zephyrus Duo 15</b>
                    <br>The latest ASUS ROG Zephyrus Duo 15 price in Malaysia market starts from RM14350.<br>
                    <a href="{{ route('laptopDetails', ['id' => 31]) }}">
                  <button type="button" class="btn btn-info" style="font-size:22px">Learn more</button></div>
                  </a>
                  </div>
                  <div class="carousel-item">
                    <img src="images/Dell Alienware m17.jpg" class="d-block mx-auto" alt="..." style="width: 500px !important;height: 500px !important;position: center !important">
                    <div class="product-content" style="color:black; background-color: #fff; text-align: center; font-size:22px"><b>Dell Alienware M17</b>
                    <br>The latest Dell Alienware M17 R3 price in Malaysia market starts from RM9605.<br>
                    <a href="{{ route('laptopDetails', ['id' => 73]) }}">
                  <button type="button" class="btn btn-info" style="font-size:22px">Learn more</button></div>
                  </a>
                  </div>
                  <div class="carousel-item">
                    <img src="images/Acer Predator Triton 900.jpg" class="d-block mx-auto" alt="..." style="width: 600px !important;height: 500px !important;position: center !important">
                    <div class="product-content" style="color:black;  background-color: #fff; text-align: center; font-size:22px"><b>Acer Predator Triton 900</b>
                    <br>The latest Acer Predator Triton 900 PT917-71 price in Malaysia market starts from RM7899.<br>
                    <a href="{{ route('laptopDetails', ['id' => 107]) }}">
                  <button type="button" class="btn btn-info" style="font-size:22px">Learn more</button></div>
                  </a>
                  </div>
                  <div class="carousel-item">
                    <img src="images/Microsoft Surface Laptop Studio 2.png" class="d-block mx-auto" alt="..." style="width: 500px !important;height: 500px !important;position: center !important">
                    <div class="product-content" style="color:black;  background-color: #fff; text-align: center; font-size:22px"><b>Microsoft Surface Laptop Studio 2</b>
                    <br>The latest Microsoft Surface Laptop Studio 2 price in Malaysia market starts from RM12199.<br>
                    <a href="{{ route('laptopDetails', ['id' => 67]) }}">
                  <button type="button" class="btn btn-info" style="font-size:22px">Learn more</button></div>
                  </a>
                  </div>
                  <div class="carousel-item">
                    <img src="images/Lenovo IdeaPad Slim 5 G8.png" class="d-block mx-auto" alt="..." style="width: 500px !important;height: 500px !important;position: center !important">
                    <div class="product-content" style="color:black;  background-color: #fff; text-align: center; font-size:22px"><b>Lenovo Ideapad 3 Slim</b>
                    <br>The latest Lenovo IdeaPad Slim 3 16 Gen 8 AMD price in Malaysia market starts from RM2959.<br>
                    <a href="{{ route('laptopDetails', ['id' => 53]) }}">
                  <button type="button" class="btn btn-info" style="font-size:22px">Learn more</button></div>
                  </a>
                  </div>
                </div>
               <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </button>
              </div>
        </div>
        <div class="col-sm-3 col-md-3"> 
      </div>      
</div>

<div>
  <br><br><br><br><br>
  <h2 class="rs-mainheader">&nbsp;The top choice.</h2>
  <span class="rs-subheader">Take a look on what's trending now.</span><br><br>
</div>

<div class="container">
  <div class="carousel-view">
    <button id="prev-btn" class="prev-btn">
     <svg viewBox="0 0 512 512" width="60" title="chevron-circle-left">
  <path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
</svg>
    </button>
    <div id="item-list" class="item-list">
        @foreach ($topLaptops as $laptop)
            <div class="img-container">
            <a href="{{ route('laptopDetails', ['id' => $laptop->id]) }}">
              <img src="{{ asset('images/') }}/{{$laptop->image}}" class="item" id="item">
              <div class="content">
                <h1 style="margin-bottom: 23rem"></h1>
              </div>
            </a>
          </div>
        @endforeach

        </div>
    <button id="next-btn" class="next-btn">
          <svg viewBox="0 0 512 512" width="60" title="chevron-circle-right">
  <path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z" />
</svg>
        </button>
    </div>
</div>
<br><br>


<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

<script>
  const prev = document.getElementById('prev-btn')
const next = document.getElementById('next-btn')
const list = document.getElementById('item-list')

const itemWidth = 300
const padding = 10

prev.addEventListener('click',()=>{
  list.scrollLeft -= itemWidth + padding
})

next.addEventListener('click',()=>{
  list.scrollLeft += itemWidth + padding
})
</script>

@endsection