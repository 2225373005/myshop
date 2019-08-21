<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>发送消息</title>
</head>
<body>
   <table>
       <tr>
           <td>id</td>
           <td>用户名</td>
           <td>操作</td>
       </tr>
       @foreach($data as $v)
       <tr>
           <td>{{$v->id}}</td>
           <td>{{$v->name}}</td>
           <td><a href="{{url('xxxx/xiao')}}?id={{$v->id}}">发送消息</a></td>
       </tr>
       @endforeach
   </table>
</body>
</html>