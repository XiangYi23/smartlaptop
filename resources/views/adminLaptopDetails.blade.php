@extends('adminLayout')
@section('content')

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
    .title{
        display:flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        
        align-items: center;

    }

    .product-image {
        width: 300px;
        margin-left:10px;
        margin-right: 30px;
        margin-bottom:10px;
    }



    .product-title{
        padding-top:5px;
    }

    .product-details button {
    font-size: 18px;
    display: inline-block;
    outline: 0;
    border: 0;
    cursor: pointer;
    will-change: box-shadow,transform;
    background: radial-gradient( 100% 100% at 100% 0%, #89E5FF 0%, #5468FF 100% );
    box-shadow: 0px 0.01em 0.01em rgb(45 35 66 / 40%), 0px 0.3em 0.7em -0.01em rgb(45 35 66 / 30%), inset 0px -0.01em 0px rgb(58 65 111 / 50%);
    padding: 0 2em;
    border-radius: 0.3em;
    color: #fff;
    height: 2.6em;
    width: 150px;
    text-shadow: 0 1px 0 rgb(0 0 0 / 40%);
    transition: box-shadow 0.15s ease, transform 0.15s ease;
}

button:hover {
    box-shadow: 0px 0.1em 0.2em rgb(45 35 66 / 40%), 0px 0.4em 0.7em -0.1em rgb(45 35 66 / 30%), inset 0px -0.1em 0px #3c4fe0;
    transform: translateY(-0.1em);
}

button:active {
    box-shadow: inset 0px 0.1em 0.6em #3c4fe0;
    transform: translateY(0em);
}

.table-title{
    font-size: 1.8rem;
    display:center;

}

table td,
table th {
    text-overflow: ellipsis;
    white-space: wrap;
    overflow: hidden;   
}
.hardware-line {
    border-bottom: 1px solid #fff; /* 使用 border-bottom 来创建底边线 */
    text-align: center;
    padding: 5px;
}
.non{
    font-size: 1.2rem;
}

thead th,
tbody th {
  color: #fff;
}

tbody td {
  font-weight: 500;
  color: rgba(255,255,255,.65);
}

.card {
  margin-top: 10px;
  border-radius: .5rem;
  margin-bottom:15px;
  color: while;
}

.modal-title{
  padding-left: 35%;
}

.modal-content{
  background: linear-gradient(145deg, transparent 50%,#e81cff, #40c9ff) border-box;
  border: 2px solid transparent;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  cursor: pointer;
  transform-origin: right bottom;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}

.close.no-hover:hover {
    box-shadow: none;
  }

.cartimg{
  max-width: 100%;
    max-height: 100%;
}
.cart{
  width: 200px;
  height: 200px;
}

.product-container {
    display: flex;
    align-items: center;
}

/*favorite*/
.red-heart {
    color: red; /* 设置为你想要的红色 */
}

.gray-heart{
    color:gray;
}
.favorite-button{
    color: #333;
    background-color: while;
    font-size: 17px;
    line-height: 38px;
    width: 38px;
    height: 38px;
    border: 1px solid #333;
    border-bottom: none;
    display: block;
    transition: all 0.3s;
    margin-top: 10px;
}

/**review */
.review {
        border: 1px solid #ccc;
        width: 95%;
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
        padding: 5px;
        border-top: 1px solid #ccc;
        background:#f8f9fa;
    }

@media (max-width: 768px){
  .product-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .left{
    margin-left: -33%;
  }
  .card{
    margin-top: 10px;
  }

  .card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 0.7rem;
  }

  .review-header{
    padding: 5px;
  }
  
  .modal-title{
    padding-left: 20%;
  }
}
.separator {
    width: 100%;
    border-top: 2px solid; /* 横线的样式和颜色 */
    margin: 10px 0; /* 调整横线与内容的间距 */
    color: while;
}
</style>

<script>
  $(document).ready(function() {
    $('#productModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var productData = button.data('product');
      var externalLink = button.data('link');
      var modal = $(this);
      modal.find('#externalLink').attr('href', externalLink);
    });
  });
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="row">
  <div class="col-md-12 col-sm-12">
      <h2 class="title">Laptop Details</h2> 
      <div class="container">
        <div class="product-container">            
          <div class="left">
              <img src="{{ asset('images/') }}/{{$laptops->image}}" class="product-image" alt="Reno 10 Pro 5G">
          </div>
          <div class="product-details">
              <h1 class="product-title">{{$laptops->manufacturer}} {{ $laptops->name }} {{ $laptops->memory }}</h1>
              <h6>Price: RM{{ $laptops->price }}</h6>
              <h6>{{ $laptops->process_model  }}</h6>
              <button class="btn btn-info" data-toggle="modal" data-target="#productModal" data-product="{{ json_encode($laptops) }}">Buy</button> 
              <!-- Add the Compare button here -->
              <a href="{{ route('adminCompareLaptop', ['id' => $laptops->id]) }}" class="btn btn-info">Compare</a>
              <form method="post" action="{{ route('favorites.toggle', ['laptopId' => $laptops->id]) }}">
                @csrf
                <button type="submit" class="favorite-button">
                    <i class="fa {{ $laptops->isFavoritedByUser(auth()->user()->id) ? 'fa-heart red-heart' : 'fa-heart gray-heart' }}"></i>
                </button>
              </form>
          </div>
        </div>   

        <div class="modal" id="productModal" tabindex="-1" role="dialog" aria-label="Modal" aria-modal="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header" style="border:none;">
                <h3 class="modal-title">Where you can buy</h3>
                  <button type="button" class="close no-hover" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            <div class="modal-body col-sm-12 d-flex justify-content-center">
                <div class="row">
                <div class="col-6 text-center mb-4">
                  <div class="cart">
                    @if(!empty($laptops->shopee))
                    <a href="{{ $laptops->shopee }}">
                      <img src="{{ asset('images/Shopee_logo.svg.png') }}" style="width:80px;" class="cartimg">
                      <div style="color:black; padding:20px 20px 20px 10px">Shopee</div>
                    </a>
                    @endif
                  </div>
                </div>
                <div class="col-6 text-center mb-4">
                  <div class="cart">
                    @if(!empty($laptops->lazada))
                    <a href="{{ $laptops->lazada }}">
                        <img src="{{ asset('images/lazada_logo.png') }}" style="width:139px;">
                        <div style="color:black; padding:20px 20px 20px 20px">Lazada</div>
                    </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          <div class="modal-footer" style="border:none;">
        </div>
      </div>
    </div>
  </div>
        
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card bg-dark shadow-2-strong">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-dark table-borderless mb-0">
                    <thead>
                      <tr>
                        <th colspan="3" class="table-title text-center">Performance</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="non">Manufacturer</th>
                        <td>{{ $laptops->manufacturer}}</td>
                      </tr>
                      <tr>
                        <th class="non">Process</th>
                        <td>{{ $laptops->process_model }}</td>
                      </tr>
                      <tr>
                        <th class="non">Graphics</th>
                        <td>{{ $laptops->graphics }}</td>
                      </tr>
                      <tr class="separator"></tr>
                      <tr>
                        <th colspan="2" class="hardware-line">Display</th>
                      </tr>
                      <tr>
                        <th class="non">Technology</th>
                        <td>{{ $laptops->display_technology }}</td>
                      </tr>
                      <tr>
                        <th class="non">Screen Size</th>
                        <td>{{ $laptops->screen_size }}</td>
                      </tr>
                      <tr>
                        <th class="non">Screen Resolution</th>
                        <td>{{ $laptops->screen_resolution }}</td>
                      </tr>
                      <tr class="separator"></tr>
                      <tr>
                        <th colspan="2" class="hardware-line">System</th>
                      </tr>
                      <tr>
                        <th class="non">Storage</th>
                        <td>{{ $laptops->storage }}</td>
                      </tr>
                      <tr>
                        <th class="non">Memory</th>
                        <td>{{ $laptops->memory }}</td>
                      </tr>
                      <tr>
                        <th class="non">Operating System</th>
                        <td>{{ $laptops->operating_system }}</td>
                      </tr>
                      <tr>
                        <th class="non">Connectivity</th>
                        <td>{{ $laptops->connectivity }}</td>
                      </tr>
                      <tr class="separator"></tr>
                      <tr>
                        <th colspan="2" class="hardware-line">HardWare</th>
                      </tr>
                      <tr>
                        <th class="non">Camera</th>
                        <td>{{ $laptops->camera }}</td>
                      </tr>
                      <tr>
                        <th class="non">Ports</th>
                        <td>{{ $laptops->ports}}</td>
                      </tr>
                      <tr>
                        <th class="non">Battery</th>
                        <td>{{ $laptops->battery }}</td>
                      </tr>
                      <tr>
                        <th class="non">Height</th>
                        <td>{{ $laptops->height }}</td>
                      </tr>
                      <tr>
                        <th class="non">width</th>
                        <td>{{ $laptops->width }}</td>
                      </tr>
                      <tr>
                        <th class="non">depth</th>
                        <td>{{ $laptops->depth }}</td>
                      </tr>
                      <tr>
                        <th class="non">Weight</th>
                        <td>{{ $laptops->weight }}</td>
                      </tr>
                      <tr>
                        <th class="non">Type</th>
                        <td>{{ $laptops->type }}</td>
                      </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
         </div>
  </div>

  <div class="col-md-12 col-sm-12">
    <div class="container">
        <h1 class="mt-5 mb-5">Review & Rating </h1>
        <div class="card">
          <div class="card-header">{{ $laptops->name }}</div>
          <div class="review-body">
            <div class="row">
              <div class="col-sm-4 text-center">
                <h1 class="text-warning mt-4 mb-4">
                  <b><span id="average_rating">0.0</span> / 5</b>
                </h1>
                <div class="mb-3">
                  <i class="fas fa-star star-light mr-1 main_star"></i>
                              <i class="fas fa-star star-light mr-1 main_star"></i>
                              <i class="fas fa-star star-light mr-1 main_star"></i>
                              <i class="fas fa-star star-light mr-1 main_star"></i>
                              <i class="fas fa-star star-light mr-1 main_star"></i>
                </div>
                <h3><span id="total_review">0</span> Review</h3>
              </div>
              <div class="col-sm-4">
                <p>
                    <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                    <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                    </div>
                </p>
                <p>
                    <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                    
                    <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                    </div>               
                </p>
                <p>
                    <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                    
                    <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                    </div>               
                </p>
                <p>
                    <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                    
                    <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                    </div>               
                </p>
                <p>
                  <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                  
                  <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                  <div class="progress">
                      <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                  </div>               
              </p> 
              <div id="currentUserName" data-username="{{ auth()->user()->name }}"></div>
                @if ($laptops->reviews->isNotEmpty())
                    <div id="reviewId" data-reviewid="{{ $laptops->reviews->first()->id }}"></div>
                @else
                    <div id="reviewId" data-reviewid="0"></div>
                @endif
              </div>
              <div class="col-sm-4 text-center">
                <h3 class="mt-4 mb-3">Write Review Here</h3>
                <button type="button" name="add_review" id="add_review" class="btn btn-primary" data-toggle="modal" data-target="#review_modal">Review</button>
              </div>
            </div>
          </div>
        </div>
       

        <div class="mt-5" id="review_content"></div>
      </div>

  <div id="review_modal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Submit Review</h5>
              <button type="button" class="close  no-hover" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="laptop_id" value="{{ $laptops->id }}">

              <h4 class="text-center mt-2 mb-4">
                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                      <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                      <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                      <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                      <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
              </h4>
              <div class="form-group">
                @if(isset($user))
                    <input type="text" name="user_id" id="user_id" value="{{$user->name}}" class="form-control" readonly="readonly"/>
                @endif
              </div>
              <input type="hidden" id="laptop_id" value="{{ $laptops->id }}">
              <div class="form-group">
                <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
              </div>
              <div class="form-group text-center mt-4">
                <button type="button" class="btn btn-primary" id="save_review">Submit</button>
              </div>
            </div>
        </div>
      </div>
  </div>

  </div>
</div>

<script>

  $(document).ready(function(){
    var rating_data = 0;
    var laptop_id = '{{ $laptops->id }}'; 

    $('#add_review').click(function(){
        $('#review_modal').modal('show');
        var laptop_id = $('#laptop_id').val();
    });

   // 关闭模态框的代码
    $('.close').click(function(){
        $('#review_modal').modal('hide');
    });

    // 如果需要在模态框完全关闭后执行额外的操作，比如移除背景遮罩
    $('#review_modal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove(); // 这将移除背景遮罩
    });
    
    $(document).on('mouseenter', '.submit_star', function(){
        var rating = $(this).data('rating');
        reset_background();
        for(var count = 1; count <= rating; count++) {
            $('#submit_star_'+count).addClass('text-warning');
        }
    });

    function reset_background() {
        for(var count = 1; count <= 5; count++) {
            $('#submit_star_'+count).addClass('star-light');
            $('#submit_star_'+count).removeClass('text-warning');
        }
    }

    $(document).on('mouseleave', '.submit_star', function(){
        reset_background();
        for(var count = 1; count <= rating_data; count++) {
            $('#submit_star_'+count).removeClass('star-light');
            $('#submit_star_'+count).addClass('text-warning');
        }
    });

    $(document).on('click', '.submit_star', function(){
        rating_data = $(this).data('rating');
    });

    $('#save_review').click(function(){
    var user_review = $('#user_review').val();
    var user_id = $('#user_id').val();
    var laptop_id = $('#laptop_id').val();

    if(user_review == '') {
        alert("Please Fill Both Field");
        return false;
    }
    else {
        $.ajax({
            url: "/save-review",
            method: "POST",
            data: {
                rating_data: rating_data,
                user_review: user_review,
                laptop_id: laptop_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#review_modal').modal('hide');
                
                alert(data.message); // 显示成功消息
                if (data.review) {
                    // 可以在这里处理评论数据，例如添加到评论列表
                    var html = '';
                for (var i = 0; i < data.review.length; i++) {
                    html += '<div>';
                    html += 'User: ' + data.review[i].user_id + '<br>';
                    html += 'Rating: ' + data.review[i].rating + '<br>';
                    html += 'Review: ' + data.review[i].user_review + '<br>';
                    html += '</div>';
                }
                $('#review_content').html(html);
                }
                load_rating_data2(laptop_id);
            },
            error: function(data) {
                alert(data.responseJSON.message); // 显示错误消息
            }
        });
    }
});


    function load_rating_data(laptopId) {
        $.ajax({
            url: "/load-rating-data", // Laravel 控制器的路由
            method: "POST",
            dataType: "JSON",
            data: {
                    laptopId: laptopId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                  },
            success: function(data) {
                // 更新前端页面以显示评分和评论数据
                // 你可以根据控制器中的数据返回格式来处理数据
                // 将数据填充到 #review_content 中
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<div>';
                    html += 'Id:' + data[i].id + '<br>';
                    html += 'User: ' + data[i].user_id + '<br>';
                    html += 'Rating: ' + data[i].rating + '<br>';
                    html += 'Review: ' + data[i].user_review + '<br>';
                    html += '</div>';
                }
                $('#review_content').html(html);
            }
        });
    }
  });

  load_rating_data2('{{ $laptops->id }}');

/**delete function */
function confirmDelete(reviewId, e) {
  e.preventDefault();
  if (confirm('Are you sure to delete?')) {
      // 发送 DELETE 请求到服务器
      fetch(`/reviews/${reviewId}`, {
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

  /**评论 */
    function load_rating_data2(laptopId)
    {
        $.ajax({
            url:"/load-review-data",
            method:"POST",
            data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // 添加CSRF令牌
                    laptopId : laptopId
                  },
            dataType:"JSON",
            success:function(data)
            {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if (data.review_data.length > 0) {
                var html = '';
                var currentUserName = $('#currentUserName').data('username');
                var reviewId = $('#reviewId').data('reviewid');

                for (var count = 0; count < data.review_data.length; count++) {
                  var isReviewId = data.review_data[count].id === reviewId;
                  var isCurrentUserReview = data.review_data[count].user_name === currentUserName;
                  
                  html += `
                    <div class="review" id="review_${data.review_data[count].id}">
                      <div class="review-header">
                        <div class="laptop-info">
                          <div class="rounded-circle bg-danger text-white pt-3 pb-2 laptop-image">
                            <h3 class="text-center">${data.review_data[count].user_name.charAt(0)}</h3>
                          </div>

                          <div class="laptop-details">
                            <div class="laptop-name">${data.review_data[count].user_name}</div>
                            <div class="rating">
                              ${Array.from({ length: 5 }, (_, index) => {
                                const class_name = data.review_data[count].rating >= index + 1 ? 'text-warning' : 'star-light';
                                return `<span class="${class_name}">&#9733;</span>`;
                              }).join('')}
                            </div>
                          </div>
                        </div>

                        <div class="laptop-edit">
                          <div>
                            ${isCurrentUserReview
                              ? `
                                <form method="POST" action="${data.review_data[count].delete_link}">
                                  <button type="button" class="delete-button" onclick="confirmDelete('${data.review_data[count].id}', event)">X</button>
                                </form>
                              `
                              : ''}
                          </div>
                        </div>
                      </div>
                      <div class="review-body">
                        <div class="comment">${data.review_data[count].user_review}</div>
                      </div>
                      <div class="date">On ${data.review_data[count].datetime}</div>
                    </div>
                  `;
                }
                $('#review_content').html(html);
                }
            }
        })
    }

</script>

@endsection