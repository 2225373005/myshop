<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
  
  <style>
   .page-item{
       width: 30px;
       float: left;
   }
   ul{
    list-style: none;
   }

  </style>
</head>
<body>
   <form action="{{url('user/index')}}" method="get">
       <input type="text" name="name" value="{{$aaa}}" id="">
       <input type="submit" value="搜所">
   </form>
	<table border=2>
       <tr>
         <td>id</td>
         <td>用户名</td>
         <td>年龄</td>
         <td>操作</td>
       </tr>
        @foreach($user as $v)
        <tr>
         <td>{{$v->id}}</td>
         <td>{{$v->name}}</td>
         <td>{{$v->age}}</td>
         <td><a href="delete?id={{$v->id}}">删除</a>|<a href="{{url('user/update')}}?id={{$v->id}}">修改</a></td>
       </tr>
        @endforeach
        <tr>
	        <td colspan="4">
				{{$user->appends(['name'=>$aaa])->links()}}
			    </td>
        </tr>
	</table>
</body>
</html>