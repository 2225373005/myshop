
@extends('index.layouts.common')
@section('title', '登录')
@section('body')






	

	
	<!-- login -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>登录</h3>
			</div>
			<div class="login">
				<div class="row">
					<form action="{{url('index/login_do')}}" method="post" class="col s12">
						@csrf
						<div class="input-field">
							<input type="text" name="name1" class="validate" placeholder="用户名" required>
						</div>
						<div class="input-field">
							<input type="password" name="password" class="validate" placeholder="密码" required>
						</div>
						<a href=""><h6>忘记密码 ?</h6></a>
						<button class="btn button-default">登录</button>
						<a href="{{url('/index/register/')}}" class="btn button-default">注册</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end login -->
	
	<!-- loader -->
	<div id="fakeLoader"></div>
	<!-- end loader -->
	@endsection

