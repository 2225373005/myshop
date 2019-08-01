<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('koo/log_do')}}" method="post">
	@csrf
       <input type="text" name="name" id=""><br>
       <input type="password" name="pwd" id=""><br>
       <input type="submit" value="登录">
	</form>
</body>
</html>