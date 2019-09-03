<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分页展示</title>
</head>
<body>

    <table align="center" border="5">
        <form action="{{url('aaa/list')}}">
           用户名搜索:<input type="text" name="name" id=""><br>
            <input type="submit" value="搜索">
        </form>
        <tr>
            <td>用户名</td>
            <td>城市</td>
            <td>性别</td>
            <td>头像</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->nickname}}</td>
            <td>{{$v->city}}</td>
            <td>{{$v->sex}}</td>
            <td> <img width="50" src="{{$v->headimgurl}}" alt=""></td>
            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            <td></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6">
                {{ $data->appends(['name'=>$name,'subscribe'=>1])->links() }}
            </td>
        </tr>

    </table>
</body>
</html>