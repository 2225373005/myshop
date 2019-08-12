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
<form action="{{url('admin/biao_song_do')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$id}}"><br>
<table>
    <select name="aaa">
        <option value="1">文本</option>
        <option value="2">图片</option>
    </select>
    <br>
    <textarea name="name" id="" cols="30" rows="10"></textarea><br>
    <input type="submit" value="发送消息">
</table>
</form>
</body>
</html>