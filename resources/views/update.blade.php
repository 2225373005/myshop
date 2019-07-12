<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>
</head>
<body>
	<form action="{{url('user/save')}}" method="post">
	@csrf
  <input type="hidden" name="id" value="{{$model->id}}">
       <table>
           <tr>
           	<td>用户名</td>
           	<td><input type="text" name="name" value="{{$model->name}}" id=""></td>
           </tr>
           <tr>
           	<td>年龄</td>
           	<td><input type="text" name="age" value="{{$model->age}}"  id=""></td>
           </tr>
           <tr>
           	<td><input type="submit" value="修改"></td>
           	<td></td>
           </tr>
       </table>
	</form>
</body>
</html>