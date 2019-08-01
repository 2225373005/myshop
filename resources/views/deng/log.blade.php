<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
	<form action="{{url('deng/log_do')}}" method="post">
    
	@csrf
	   <h3><a href="{{url('deng/zhu')}}">注册</a></h3>
       <input type="text" name="name" id=""><br>
       <input type="password" name="pwd" id=""><br>
       <input type="submit" value="登录">
	</form>
</body>
</html>