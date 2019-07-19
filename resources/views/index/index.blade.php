
@extends('index.layouts.common')
@section('title', '显示')
@section('body')

<!-- navbar bottom -->
<div class="navbar-bottom">
    <div class="row">
        <div class="col s2">
            <a href="index.html"><i class="fa fa-home"></i></a>
        </div>
        <div class="col s2">
            <a href="wishlist.html"><i class="fa fa-heart"></i></a>
        </div>
        <div class="col s4">
            <div class="bar-center">
                <a href="#animatedModal" id="cart-menu"><i class="fa fa-shopping-basket"></i></a>
                <span>2</span>
            </div>
        </div>
        <div class="col s2">
            <a href="contact.html"><i class="fa fa-envelope-o"></i></a>
        </div>
        <div class="col s2">
            <a href="#animatedModal2" id="nav-menu"><i class="fa fa-bars"></i></a>
        </div>
    </div>
</div>
<!-- end navbar bottom -->




<!-- slider -->
<div class="slider">

    <ul class="slides">
        <li>
            <img src="img/slide1.jpg" alt="">
            <div class="caption slider-content  center-align">
                <h2>我的商城</h2>
                <h4>Lorem ipsum dolor sit amet.</h4>
                <a href="" class="btn button-default">SHOP NOW</a>
            </div>
        </li>
        <li>
            <img src="img/slide2.jpg" alt="">
            <div class="caption slider-content center-align">
                <h2>我的购物车</h2>
                <h4>Lorem ipsum dolor sit amet.</h4>
                <a href="" class="btn button-default">SHOP NOW</a>
            </div>
        </li>
        <li>
            <img src="img/slide3.jpg" alt="">
            <div class="caption slider-content center-align">
                <h2>我的订单</h2>
                <h4>Lorem ipsum dolor sit amet.</h4>
                <a href="" class="btn button-default">SHOP NOW</a>
            </div>
        </li>
    </ul>

</div>
<!-- end slider -->

<!-- features -->
<div class="features section">
    <div class="container">
        <div class="row">
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <h6>Free Shipping</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <h6>Money Back</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-0">
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <h6>Secure Payment</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-support"></i>
                    </div>
                    <h6>24/7 Support</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end features -->

<!-- quote -->
<div class="section quote">
    <div class="container">
        <h4>FASHION UP TO 50% OFF</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
    </div>
</div>
<!-- end quote -->

<!-- product -->
<div class="section product">
    <div class="container">
        <div class="section-head">
            <h4>NEW PRODUCT</h4>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
        </div>
    <div class="row">
@foreach($info as $v)
    
            <div class="col s6">
                <div class="content">
                    <img src="{{asset('storage').'/'.$v->goods_pic}}" alt="">
                    <h6><a href="{{url('index/details')}}?goods_id={{$v->goods_id}}">{{$v->goods_name}}</a></h6>
                    <div class="price">
                        {{$v->goods_price}}￥
                    </div>
                    <a class="btn button-default" href="{{url('index/details')}}?goods_id={{$v->goods_id}}">加入购物车</a>
                    
                </div>
            </div>

@endforeach
        </div>
    </div>
</div>
<!-- end product -->

<!-- promo -->
<div class="promo section">
    <div class="container">
        <div class="content">
            <h4>PRODUCT BUNDLE</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
            <button class="btn button-default">SHOP NOW</button>
        </div>
    </div>
</div>
<!-- end promo -->

<!-- product -->
<div class="section product">
    <div class="container">
        <div class="section-head">
            <h4>TOP PRODUCT</h4>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
        </div>
        <div class="row">
        @foreach($info1 as $v)
            <div class="col s6">
                <div class="content">
                    <img src="{{asset('storage').'/'.$v->goods_pic}}" alt="">
                    <h6><a href="{{url('index/details')}}?goods_id={{$v->goods_id}}">{{$v->goods_name}}</a></h6>
                    <div class="price">
                        {{$v->goods_price}}￥
                    </div>
                  <a class="btn button-default" href="{{url('index/details')}}?goods_id={{$v->goods_id}}">加入购物车</a>
                </div>
            </div>
  @endforeach
        </div>
        
        <div class="pagination-product">
            <ul>
                <li class="active">1</li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="">5</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- end product -->
@endsection


