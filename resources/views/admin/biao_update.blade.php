<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('admin/biao_update_do')}}" method="post">
    @csrf
    <h3>修改标签</h3>
    <input type="hidden" name="id" value="{{$id}}">
    <input type="text" name="name" id=""><br>
    <input type="submit" value="修改">
    
</form>
</body>
</html>