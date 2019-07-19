
@extends('index.layouts.common')

@section('title', '购物车显示')

@section('body')
	
	<!-- cart -->
	<div class="cart section">
		<div class="container">
			<div class="pages-head">
				<h3>我的购物车</h3>
			</div>
			<div class="content">
				



				@foreach($data as $v)
				<div class="cart-2">
					<div class="row">
						<div class="col s5">
							<h5>Image</h5>
						</div>
						<div class="col s7">
							<img src="{{asset('storage').'/'.$v->goods_pic}}" alt="">
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>商品名</h5>
						</div>
						<div class="col s7">
							<h5><a href="">{{$v->goods_name}}</a></h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Quantity</h5>
						</div>
						<div class="col s7">
							<input value="1" type="text">
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Price</h5>
						</div>
						<div class="col s7">
							<h5>${{$v->goods_price}}</h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Action</h5>
						</div>
						<div class="col s7">
							<h5><i class="fa fa-trash"></i></h5>
						</div>
					</div>
				</div>
				<div class="divider"></div>
             @endforeach
			</div>
			<div class="total">
				<div class="row">
					<div class="col s7">
						<h5>Fashion Men's</h5>
					</div>
					<div class="col s5">
						<h5>$21.00</h5>
					</div>
				</div>
				<div class="row">
					<div class="col s7">
						<h5>Fashion Men's</h5>
					</div>
					<div class="col s5">
						<h5>$20.00</h5>
					</div>
				</div>
				<div class="row">
					<div class="col s7">
						<h6>总价</h6>
					</div>
					<div class="col s5">
						<h6>${{$zongjia}}</h6>
					</div>
				</div>
			</div>
			<a href="{{url('zhifubao')}}" class="btn button-default">确认订单</a>
			
		</div>
	</div>
	<!-- end cart -->


@endsection