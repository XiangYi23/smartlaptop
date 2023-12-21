@extends('adminLayout')
@section('content')
<style>
@import url(https://fonts.googleapis.com/css?family=Signika:700,300,600);


.banner{
    background-image: url('https://i.75ll.com/up/fa/5d/ef/84d41a5bca2ea0254c714dab13ef5dfa.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* 设置 div 的宽度和高度，用于容纳背景图片 */
            width: 400px;
            height: 300px;
            /* 可以设置背景颜色作为图片加载时的备选颜色 */
            background-color: #f0f0f0;
}
.banner_img{
    position:center;
    border-radius: 100%;
    background: linear-gradient(145deg, #b7f8f1, #9ad1cb);
    box-shadow:  20px 20px 40px #80aea9,
               -20px -20px 40px #d6ffff;
}

.banner-title {
 font-size:5em;
 position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
 font:bold 7.5vw/1.6 'Signika', sans-serif;
 user-select:none;
}

.banner-title span { display:inline-block; animation:float .2s ease-in-out infinite; }
 @keyframes float {
  0%,100%{ transform:none; }
  33%{ transform:translateY(-1px) rotate(-2deg); }
  66%{ transform:translateY(1px) rotate(2deg); }
}
body:hover span { animation:bounce .6s; }
@keyframes bounce {
  0%,100%{ transform:translate(0); }
  25%{ transform:rotateX(20deg) translateY(2px) rotate(-3deg); }
  50%{ transform:translateY(-20px) rotate(3deg) scale(1.1);  }
}

.banner-text:nth-child(4n) { color:hsl(50, 75%, 55%); text-shadow:1px 1px hsl(50, 75%, 45%), 2px 2px hsl(50, 45%, 45%), 3px 3px hsl(50, 45%, 45%), 4px 4px hsl(50, 75%, 45%); }
.banner-text:nth-child(4n-1) { color:hsl(135, 35%, 55%); text-shadow:1px 1px hsl(135, 35%, 45%), 2px 2px hsl(135, 35%, 45%), 3px 3px hsl(135, 35%, 45%), 4px 4px hsl(135, 35%, 45%); }
.banner-text:nth-child(4n-2) { color:hsl(155, 35%, 60%); text-shadow:1px 1px hsl(155, 25%, 50%), 2px 2px hsl(155, 25%, 50%), 3px 3px hsl(155, 25%, 50%), 4px 4px hsl(140, 25%, 50%); }
.banner-text:nth-child(4n-3) { color:hsl(30, 65%, 60%); text-shadow:1px 1px hsl(30, 45%, 50%), 2px 2px hsl(30, 45%, 50%), 3px 3px hsl(30, 45%, 50%), 4px 4px hsl(30, 45%, 50%); }

.banner-title span:nth-child(2){ animation-delay:.05s; }
.banner-title span:nth-child(3){ animation-delay:.1s; }
.banner-title span:nth-child(4){ animation-delay:.15s; }
.banner-title span:nth-child(5){ animation-delay:.2s; }
.banner-title span:nth-child(6){ animation-delay:.25s; }
.banner-title span:nth-child(7){ animation-delay:.3s; }
.banner-title span:nth-child(8){ animation-delay:.35s; }
.banner-title span:nth-child(9){ animation-delay:.4s; }

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




<div class="row">
    <div class="col-md-12">
    <h1 class="title">Category admin</h1>
        <div class="col-md-12" >
            <div class="container">
                <div class="card-wrapper"> <!-- 新增的父元素 -->
                <div class="card">
                        <a href="{{ url('laptopCategory/apple') }}"> <img src="{{ asset('images/apple.png') }}" class="img-admin" alt="">Apple</a>
                    </div>
                    <div class="card">
                        <a href="{{ url('laptopCategory/asus') }}"> <img src="{{ asset('images/samsung2.png') }}" class="img-admin" alt="">Samsung</a>
                    </div>
                    <div class="card">
                        <a href="{{ url('laptopCategory/lenovo') }}"> <img src="{{ asset('images/oppo.png') }}" class="img-admin" alt="">OPPO</a>
                    </div>
                    <div class="card">
                        <a href="{{ url('laptopCategory/microsoft') }}"> <img src="{{ asset('images/vivo.png') }}" class="img-admin" alt="">VIVO</a>
                    </div>
                    <div class="card">
                        <a href="{{ url('laptopCategory/msi') }}"> <img src="{{ asset('images/xiaomi.png') }}" class="img-admin" alt="">Xiaomi</a>
                    </div><div class="card">
                        <a href="{{ url('laptopCategory/acer') }}"> <img src="{{ asset('images/realme.png') }}" class="img-admin" alt="">Realme</a>
                    </div><div class="card">
                        <a href="{{ url('laptopCategory/dell') }}"> <img src="{{ asset('images/huawei.png') }}" class="img-admin" alt="">Huawei</a>
                    </div><div class="card">
                        <a href="{{ url('laptopCategory/hp') }}"> <img src="{{ asset('images/honor.png') }}" class="img-admin" alt="">Honor</a>
                    </div>
                    <!-- 添加更多卡片 -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection