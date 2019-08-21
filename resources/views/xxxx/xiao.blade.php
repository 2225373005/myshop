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
        <form action="{{url('xxxx/xiao_do')}}" method="post">
            @csrf

            <table>
                <input type="hidden" name="id" value="{{$id}}">
                <tr>
                    <td>消息内容</td>
                    <td><textarea name="text" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" value="发送"></td>
                   
                </tr>
            </table>
        </form>
</body>
</html>