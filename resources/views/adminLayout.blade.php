<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUC Laptop</title>
    <link rel="website icon" type="jpeg" href="images/suclaptop.jpeg">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

<style>

:root {
    --footer-background: white;
    --text-color: #111420;
    --text-gray: #e1e1e1;
    --text-heading-gray: #b9b9b9;
}

html {
    font-size: 16px;
    font-family: 'Red Hat Display', sans-serif;
}

/*? footer reset */
*, *::after, *::before {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}


/*? footer containers */

footer {
    bottom: 0px;
    background-color: var(--footer-background);
    min-width: 300px;
    width: 100vw;
    bottom: 0px;
    display: flex;
    align-items: center;
    flex-direction: column;
}

.footer-wrapper {
    display: flex;
    background: var(--footer-background);
    flex-direction: column;
    max-width: 1320px;
    padding: 16px;
}


/*? top section */
.footer-top {
    display: flex;
    flex-wrap: wrap;
    justify-content: start;
    align-items: start;
    padding: 16px 0px;
    justify-content: space-between;
}

.footer-line {
    display: block;
    width: 100%;
    height: 8px;
    background: linear-gradient(
        90deg,#5da8ff,
        #605dff 50%,#ad63f6
    );
}

/*? footer subscribe */
.footer-subscribe {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.footer-subscribe > input {
    border: 1px solid var(--text-gray);
    color: var(--text-color);
    min-height: 36px;
    font-size: 1.2rem;
    flex: 1 0 120px;
    padding: 8px 12px;
    border-radius: 8px;
}

.footer-subscribe > button {
    cursor: pointer;
    background-color: var(--text-color);
    border-radius: 8px;
    color: white;
    font-size: 1.25rem;
    min-width: 120px;
    min-height: 36px;
    flex: 1 0 80px;
    white-space: nowrap;
    padding: 8px 12px;
    border: 0px;
    outline: none;
}

/*? footer columns */
.footer-columns {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: start;
    align-items: start;
    flex: 2 0 140px;
    width: 100%;
    gap: 16px;
    padding: 24px 8px 16px 8px;
    margin: 0 auto;
    border-top: 1px solid var(--text-gray);
}

.footer-columns ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.footer-columns ul a {
    color: var(--text-color);
    text-decoration: none;
}

.footer-columns ul a:hover{
    text-decoration: underline;
}

.footer-columns ul li {
    margin-bottom: 16px;
}

.footer-columns h3 {
    color: var(--footer-heading-gray);
    margin-top: 0;
    margin-bottom: 25px;
    font-size: 1.125rem;
}

.footer-centering {
    margin: 0 auto;
}

.footer-columns > section {
    min-width: 250px;
}   

/*? Footer bottom */

.footer-bottom {
    text-align: center;
    border-top: 1px solid var(
        --text-gray
    );
    margin-top: 48px;
    display: flex;
    align-items: center;
    width: 100%;
    gap: 8px;
    padding: 16px 0px;
    flex-wrap: wrap;
    justify-content: space-between;
}

.footer-bottom > small {
    font-size: 16px;
    margin: 0 4px;
}

.footer-headline > h2 {
    margin: 0px;
}

.footer-headline > p {
    margin: 12px 0px;
}

/*? socials */

.social-links {
    display: flex;
    flex-direction: row;
    gap: 12px;
}

.social-links img {
    width: 24px;
    height: 24px;
    transition: all 0.2s ease-in-out;
}

.social-links img:hover {
    transform: scale(1.1);
}

/*? mobile */

@media (max-width: 800px) {
    .footer-top {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 16px 8px 32px 8px;
    }

    .footer-bottom {
        display: flex;
        flex-direction: column-reverse;
        align-items: space-between;
        justify-content: center;
        margin: 0 auto;
    }
}
/**Fullscreen Navbar */
body {
  font-family: 'Raleway', sans-serif;
}
img, iframe, video, .container, .container-fluid {
    max-width: 100%;
    height: auto;
}
.navbar-toggler {
    display: none; /* Hide by default */
}
.overlay {
  height: 0%;
  width: 100%;
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
  overflow-y: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 10%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 24px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: -5px;
  left: 10px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay {overflow-y: auto;}
  .overlay a {font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}

/* Search Button Enhancement */
.btn-outline-success {
    border-radius: 25px; /* Rounded corners */
    border: none;
    background-color: #28a745; /* Green background */
    color: white;
    padding: 8px 15px;
}

.btn-outline-success:hover {
    background-color: #218838; /* Darker green on hover */
}

.buttons {
    background-color: #e67e22;
    color: #fff;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    padding: 0.5em 1em;
}

.buttons a {
    display: flex;
    align-items: center;
    gap: 8px; /* Gap between icon and text */
}

.buttons svg {
    margin-right: 5px; /* Space between icon and label */
    width: 17px;
    height: 20px;
}

.buttons:hover {
    background-color: #d35400;
}
.buttons, .btn-outline-success {
    padding: 10px 20px;
    font-size: 18px;
}

.openNavbar{
    font-size:40px;
    color:white;
    cursor:pointer;
}

.classify{
    display: flex;
    flex-wrap: nowrap;
}

/* iPhone (portrait) */
@media only screen and (max-width: 480px) {
    .navbar-toggler {
        display: inline-block; /* 确保在小屏幕上显示切换按钮 */
    }

    .navbar-collapse {
        display: none; /* 默认不展示折叠内容 */
    }

    .navbar-expand .navbar-toggler:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .navbar-nav .nav-link {
        padding: .5rem 1rem; /* 增加较大的点击区域 */
    }
    .overlay-content a {
        padding: 15px;
        font-size: 18px;
    }
    .openNavbar{
        width: 35px;
    }
    /* 调整关闭按钮大小 */
    .overlay .closebtn {
        top: -22px;
        right: 35px;
    }
    
    /* 导航链接样式调整以适应触摸屏 */
    .overlay a {
        font-size: 18px;
        padding: 15px;
    }
    
    /* 调整覆盖层内容的上边距 */
    
    .form-inline {
        flex-wrap: nowrap;
    }
    /* 搜索按钮和其他按钮的样式调整 */
    .buttons, .btn-outline-success {
        display: contents;
        padding: 10px 20px;
        font-size: 18px; /* 增加字体大小以适应触摸屏 */
    }
    .buttons-overlay{
        display:none;
    }
    
    .form-control {
        margin-right: 7px;
    }
    
}

/* iPad (portrait and landscape) */
@media only screen and (min-width: 481px) and (max-width: 1024px) {
    .navbar-toggler {
        display: block;
    }

    .navbar-collapse {
        display: none;
    }

    .navbar-expand .navbar-toggler:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .navbar-nav .nav-link {
        padding: .5rem 1rem;
    }

    /* 在中等屏幕上保持覆盖层关闭按钮的较大大小 */
    .overlay .closebtn {
        font-size: 60px;
    }
    
    /* 调整覆盖层链接的大小 */
    .overlay a {
        font-size: 22px;
        padding: 20px;
    }
    
    /* 调整覆盖层内容的上边距 */
    .overlay-content {
        margin-top: 45px;
    }
    .overlay-content a {
        padding: 20px;
        font-size: 22px;
    }
    /* 搜索按钮和其他按钮的样式微调 */
    .buttons, .btn-outline-success {
        padding: 12px 24px;
        font-size: 20px; /* 适中的字体大小 */
    }
}

@media only screen 
  and (min-width: 1024px) 
  and (max-width: 2732px) {

    .navbar-toggler {
        display: inline-block; /* 确保在小屏幕上显示切换按钮 */
    }

    .navbar-collapse {
        display: none; /* 默认不展示折叠内容 */
    }

    .navbar-expand .navbar-toggler:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .navbar-nav .nav-link {
        padding: .5rem 1rem; /* 增加较大的点击区域 */
    }
    .overlay-content a {
        padding: 140%;
        font-size: 12px;
    }
    .openNavbar{
        width: 35px;
    }
    /* 调整关闭按钮大小 */
    .overlay .closebtn {
        top: -22px;
        right: 35px;
    }
    
    /* 导航链接样式调整以适应触摸屏 */
    .overlay a {
        font-size: 18px;
        padding: 15px;
    }
    
    .form-inline {
        flex-wrap: nowrap;
    }
    /* 搜索按钮和其他按钮的样式调整 */
    .buttons, .btn-outline-success {
        display: contents;
        padding: 10px 20px;
        font-size: 18px; /* 增加字体大小以适应触摸屏 */
    }
    
    .form-control {
        margin-right: 7px;
    }

}
</style>

<div>
<nav class="navbar navbar-expand navbar-dark bg-dark">
<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    <div class="classify">
        <div class="col-md-4 col-sm-4"><a style="color:white">Function</a></div>
        <div class="col-md-4 col-sm-4"><a style="color:white">Brand</a></div>
        <div class="col-md-4 col-sm-4"><a style="color:white">Manage</a></div>
    </div>
    <div class="classify">
        <div class="col-md-4 col-sm-4">
            <a href="{{ url('/laptop-filter') }}">Laptops</a>
            <a href="{{ url('/adminReviewHistory') }}">Reviews History</a>
            <a href="{{ url('/adminFavorites') }}">Favourite List</a>
        </div>
        <div class="col-md-4 col-sm-4">
            <a href="{{ url('adminLaptopCategory/apple') }}">Apple</a>
            <a href="{{ url('adminLaptopCategory/asus') }}">Asus</a>
            <a href="{{ url('adminLaptopCategory/lenovo') }}">Lenovo</a>
            <a href="{{ url('adminLaptopCategory/microsoft') }}">Microsoft</a>
            <a href="{{ url('adminLaptopCategory/msi') }}">MSI</a>
            <a href="{{ url('adminLaptopCategory/acer') }}">Acer</a>
            <a href="{{ url('adminLaptopCategory/dell') }}">Dell</a>
            <a href="{{ url('adminLaptopCategory/hp') }}">HP</a>
        </div>
        <div class="col-md-4 col-sm-4">
            <a href="{{ url('/adminPage/store') }}">Admin Page</a>
            <a href="{{ url('add') }}">Add</a>
            <a href="{{ url('/selectLaptop/store') }}">Edit</a>
            <a href="{{ url('/selectLaptop/store') }}">Delete</a>
            <a href="{{ url('/feedbackManage') }}">Feedback Manage</a>
        </div>
    </div>
  </div>
</div>
<span style="font-size:40px;" class="navbar-brand openNavbar" onclick="openNav()">&#9776;</span>
    <a href="{{ url('/adminPage/store') }}" class="navbar-brand" style="font-size:40px">&#127968;</a>
        <button type="buttons" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"></ul>
        
        <form class="form-inline my-2 my-lg-0" action="{{route('adminSearchLaptop')}}" method="post" style="flex-wrap: nowrap;">
            @csrf
            <input class="form-control mr-sm-2" name="keyword" type="search" placeholder="Search" aria-label="Search">
            <button class="buttons btn-outline-success my-2 my-sm-0" type="submit" style="font-size:17.5px"><i class="fas fa-search"></i></button>
        </form>


        <a href="#" class="nav-item nav-link"></a>
        <!-- ... 您的登录/登出按钮代码 ... -->
        <div class="buttons">
            <div class="buttons-overlay">
                @auth
                    <a class="buttons" href="{{ route('adminProfile', ['id' => auth()->user()->id]) }}">Profile</a>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fas fa-user"></i> Login
                    </a>
                @endauth
            </div>
        </div>
</nav>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        @yield('content')  
    </div>
</div>

<div class="content">
    <!-- ... 其他内容 ... -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</div>

<!-- 添加 Bootstrap 的 JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<!-- 搜索功能的 JavaScript -->
<script>
$(document).ready(function() {
    // 修改这里的按钮类名为 .buttons.search-button
    $('.buttons.search-button').on('click', function() {
        var searchTerm = $('.input-search').val();
        if (searchTerm.trim() !== '') {
            searchProducts(searchTerm);
        }
    });
});

function searchProducts(searchTerm) {
    $.ajax({
        url: '/search/products',
        type: 'GET',
        data: { searchTerm: searchTerm },
        success: function(response) {
            displaySearchResults(response);
        },
        error: function(error) {
            console.error('Error performing product search: ', error);
        }
    });
}

// Assuming this function is called when you receive search results from the server
function displaySearchResults(results) {
    console.log(results);
    var $searchResultsContainer = $('.search-results');
    $searchResultsContainer.empty();
    
    if (results.length === 0) {
        $searchResultsContainer.append('<p>No results found.</p>');
    } else {
        results.forEach(function(product) {
            var productHTML = `
                <div class="product">
                    <img src="${product.image}" alt="${product.name}" class="product-image">
                    <h3 class="product-name">${product.name}</h3>
                    <p class="product-price">${product.price}</p>
                    <!-- Other product information fields can also be displayed here -->
                </div>
            `;
            $searchResultsContainer.append(productHTML);
        });
    }
}


function openNav() {
    document.getElementById("myNav").style.width = "100%";
    document.getElementById("myNav").style.height = "80%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    document.getElementById("myNav").style.height = "0%";
}

</script>

<!--Bottom Footer-->
<footer>
    <div class="footer-columns">
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            <h2>SUC Laptop</h2>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
        </section>
        <section>
            <h3>Function</h3>
            <ul>
                <li>
                    <a href="{{ url('*') }}" title="Laptops">Laptops</a>
                </li>
                <li>
                    <a href="{{ url('/userFeedback',['id' => auth()->user()->id]) }}" title="Feedback">Feedback</a>
                </li>
            </ul>
        </section>
        <section>
            <h3>Resources</h3>
            <ul>
            <li>
                    <a href="{{ route('aboutUs') }}" title="About Us">About Us</a>
                </li>
                <li>
                    <a href="{{ route('contactUs') }}" title="Contact Us">Contact Us</a>
                </li>
            </ul>
        </section>
        <section>
            <h3>Guidelines</h3>
            <ul>
                <li>
                    <a href="{{ route('tutorial') }}" title="Tutorial">Tutorial</a>
                </li>
                <li>
                    <a href="{{ route('disclaimer') }}" title="Disclaimer">Disclaimer</a>
                </li>
                <li>
                    <a href="{{ route('privacyPolicy') }}" title="Privacy Policy">Privacy Policy</a>
                </li>
            </ul>
        </section>
        <section>
            <h3>Account</h3>
            <ul>
                <li>
                    <a href="{{ route('userProfile', ['id' => auth()->user()->id]) }}" title="Profile">Profile</a>
                </li>
                <li>
                    <a href="{{ route('reviewHistory', ['id' => auth()->user()->id]) }}" title="Review History">Review History</a>
                </li>
                <li>
                    <a href="{{ route('favoritesList', ['id' => auth()->user()->id]) }}" title="Favourite List">Favourite List</a>
                </li>
            </ul>
        </section>
    </div>
    <div class="footer-bottom">
        <small>© SUC Laptop <span id="year"></span>, All rights reserved.</small>
    </div>
    </div>
    </footer>
    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
</body>
</html>
