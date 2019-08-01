<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
	<form action="{{url('ting/log_do')}}" method="post">
	@csrf
      用户名 :  <input type="text" name="name" id=""><br>
      密码:  <input type="password" name="pwd" id=""><br>
      <input type="submit" value="登录">
	</form>
</body>
</html>