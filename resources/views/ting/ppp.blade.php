<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车库管理系统</title>
</head> 
<body>
	<h3>车库管理系统</h3>
	<h3>小区车位:{{$info}}&nbsp; &nbsp;&nbsp;剩余停车位:{{$num}} </h3>
	<button><a href="{{url('ting/save')}}">车辆入库</a></button>&nbsp;&nbsp;&nbsp;<button><a href="{{url('ting/save_do')}}">车辆出库</a></button>
</body>
</html>