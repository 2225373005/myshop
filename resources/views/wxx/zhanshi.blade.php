<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>粉丝列表</title>
</head>
<body>
	<table border="5">
       <tr>
       	<td>用户</td>
       	<td>操作</td>
       </tr>
       @foreach($info as $v)
       <tr>
       	<td>{{$v->nickname}}</td>
       	<td><a href="{{url('wxx/zsxq')}}?id={{$v->id}}">用户详情</a></td>
       </tr>
       @endforeach
	</table>
</body>
</html>