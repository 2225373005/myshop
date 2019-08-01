<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加停车数量</title>
</head>
<body>
	<form action="{{url('ting/add_do')}}" method="post">
	@csrf
       小区名: <input type="text" name="name" id=""><br>
       可停车辆: <input type="text" name="num" id=""><br>

       <input type="submit" value="添加可停车辆">
	</form>
</body>
</html>