<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车辆入库</title>
</head>
<body>
	<h3>车辆入库</h3><br>
	<form action="{{url('ting/ru')}}" method="post">
	 @csrf
      车牌号: <input type="text" name="name" id=""><br>
      <input type="submit" value="添加入库">
	</form>
</body>
</html>