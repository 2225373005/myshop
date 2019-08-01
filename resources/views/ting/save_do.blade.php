<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车辆出库</title>
</head>
<body>
	<h3>车辆出库</h3><br>
	<form action="{{url('ting/shou')}}" method="post">
	 @csrf
      车牌号: <input type="text" name="name" id=""><br>
      <input type="submit" value="车辆出库">
	</form>
</body>
</html>