@extends('index.layouts.common')
@section('title', '详情显示')
@section('body')

	
	<!-- single post -->
	<div class="pages section">
		<div class="container">
			<div class="blog-single">
				<img src="{{asset('storage').'/'.$info->goods_pic}}" alt="">
				<div class="blog-single-content">
					<h5>{{$info->goods_name}}</h5>
					<div class="date">
						<span><i class="fa fa-calendar"></i>{{$info->goods_price}}</span>
					</div>
					<p>{{$info->goods_content}}</p>	
					<div class="share-post">	
						<ul>
							<li><a href=""><i class="fa fa-facebook"></i></a></li>
							<li><a href=""><i class="fa fa-twitter"></i></a></li>
							<li><a href=""><i class="fa fa-google"></i></a></li>
							<li><a href=""><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>	
				
				<div class="comment-form">
					
					<div class="row">
						
					
							<div class="form-button">
								
								<a href="{{url('index/cart')}}?goods_id={{$info->goods_id}}" class="btn button-default">加入购物车</a>
							</div>
						
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!-- end single post -->
	
@endsection
	
