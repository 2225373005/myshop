<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
	<form action="{{url('kao/logs_do')}}" method="post">
	@csrf
       <table border="6">
          <tr>
          	<td>用户名</td>
          	<td><input type="text" name="name" id=""></td>
          </tr>
          <tr>
          	<td>密码</td>
          	<td><input type="password" name="pwd" id=""></td>
          </tr>
          <tr>
          	<td><input type="submit" value="登录">	</td>
          	<td></td>
          </tr>
       </table>
	</form>
</body>
</html>