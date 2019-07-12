
@extends('index.layouts.common')
@section('title', '注册')
@section('body')


	<!-- side nav right-->
	<div class="side-nav-panel-right">
		<ul id="slide-out-right" class="side-nav side-nav-panel collapsible">
			<li class="profil">
				<img src="img/profile.jpg" alt="">
				<h2>John Doe</h2>
			</li>
			<li><a href="setting.html"><i class="fa fa-cog"></i>Settings</a></li>
			<li><a href="about-us.html"><i class="fa fa-user"></i>About Us</a></li>
			<li><a href="contact.html"><i class="fa fa-envelope-o"></i>Contact Us</a></li>
			<li><a href="login.html"><i class="fa fa-sign-in"></i>Login</a></li>
			<li><a href="register.html"><i class="fa fa-user-plus"></i>Register</a></li>
		</ul>
	</div>
	<!-- end side nav right-->

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

	

	

	
	<!-- register -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>注册表</h3>
			</div>
			<div class="register">
				<div class="row">
					<form action="{{url('index/register_do')}}" method="post" class="col s12">
					@csrf
						<div class="input-field">
							<input type="text" name="name1" class="validate" placeholder="用户名" required>
						</div>
						<div class="input-field">
							<input type="email" name="email" placeholder="邮件" class="validate" required>
						</div>
						<div class="input-field">
							<input type="password" name="password" placeholder="密码" class="validate" required>
						</div>
						<button class="btn button-default" >注册</button>
						
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end register -->
	

	<!-- loader -->
	<div id="fakeLoader"></div>
	<!-- end loader -->
	@endsection



