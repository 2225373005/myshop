<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<table border=4>
       <tr>
        <td>用户名</td>
       	<td>{{$info->nickname}}</td>
       </tr>
       <tr>
       	<td>头象</td>
       	<td><img src="{{$info->headimgurl}}" alt=""></td>
       </tr>
       <tr>
       	<td>添加时间</td>
       	<td>{{date('Y-m-d H:i:s',$info->add_time)}}</td>
       </tr>
       <tr>
       	<td>性别</td>
       	<td>
  			@if($info->sex==1)
  				男
  			@else
   				女
  			@endif

       	</td>
       </tr>
       <tr>
       	<td>地址</td>
       	<td>{{$info->city}}</td>
       </tr>
	</table>
</body>
</html>