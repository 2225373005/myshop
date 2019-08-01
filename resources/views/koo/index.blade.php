<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="container">
    <table  border="3">
  			<tr>
  				<td>新闻id</td>
  				<td>新闻标题</td>
  				<td>新闻图片</td>
  				<td>新闻作者</td>
  				<td>添加时间</td>
  				<td>操作</td>
  			</tr>
  			@foreach ($users as $user)
  			<tr>
  				<td> {{ $user->x_id }}</td>
  				<td>{{ $user->x_title }}</td>
  				<td><img width="50" src="{{asset('storage').'/'.$user->x_file }}" alt=""></td>
  				<td>{{ $user->x_name }}</td>
  				<td>{{date('Y-m-d H:i:s',$user->add_time)}}</td>

  				<td>
                 @if($user->id==$id)
  						<a href="{{url('koo/delete')}}?id={{$user->x_id}}">删除</a>|
                 @endif

  				<a href="{{url('koo/list')}}?id={{$user->x_id}}">前往行情页</a>
  				</td>
  			</tr>
    @endforeach
    </table>

    
       
  
   </div>
   {{ $users->links() }}
</body>
</html>