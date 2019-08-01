<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加门卫</title>
</head>
<body>
	<form action="{{url('ting/men_do')}}" method="post">
	@csrf
       用户名 : <input type="text" name="name" id=""><br>
       密码 : <input type="password" name="pwd" id="">	<br>
       <input type="submit" value="注册用户">
	</form>

</body>
</html>