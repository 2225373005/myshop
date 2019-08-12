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
<form action="{{url('admin/biao_da_do')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <table border="4">
    <tr>
        <td>id</td>
        <td>openid</td>
        <td>操作</td>
    </tr>
@foreach($data['openid'] as $v)
    <tr>
        <td>
            <input type="checkbox" name="name[]" value="{{$v}}" id="">
        </td>
        <td>{{$v}}</td>
        <td></td>
    </tr>
@endforeach
        <tr>
            <td colspan="3" align="center">
                <input type="submit" value="添加标签">
            </td>
        </tr>

    </table>
    
    
</form>
</body>
</html>