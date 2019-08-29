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
<form action="{{url('admin/class_update_do')}}" method="post">
    @csrf
    <input type="hidden" name="openid" value="{{$data->openid}}">
    <input type="hidden" name="num" value="{{$data->num}}">
      <table>
          <tr>
              <td>课程1</td>
              <td><input type="text" name="class1" value="{{$data->class1}}" id=""></td>
          </tr>
          <tr>
              <td>课程2</td>
              <td><input type="text" name="class2" value="{{$data->class2}}"  id=""></td>
          </tr>
          <tr>
              <td>课程3</td>
              <td><input type="text" name="class3" value="{{$data->class3}}" id=""></td>
          </tr>
          <tr>
              <td>课程4</td>
              <td><input type="text" name="class4" value="{{$data->class4}}"  id=""></td>
          </tr>
          <tr>
              <td></td>
              <td><input type="submit" value="修改"></td>
          </tr>
      </table>
</form>
</body>
</html>