<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我要表白</title>
</head>
<body>
<form action="{{url('admin/biao_woyao_do')}}" method="post">
    @csrf
   <table align="center">
       <tr>

           <td colspan="2" align="center">表白内容</td>
       </tr>
       <tr>
           <td colspan="2"><textarea name="text" id="" cols="30" rows="10"></textarea></td>

       </tr>
       <tr>
           <td>是否匿名</td>
           <td><input type="radio" name="name" value="匿名用户" id="">是
               <input type="radio" name="name" value="{{$xxoo}}" id="">否
           </td>
       </tr>
       <tr>
           <td>要表白的人</td>
           <td>
               <select name="openid" id="">
                    @foreach($data as $v)
                   <option value="{{$v['openid']}}">{{$v['nickname']}}</option>
                   @endforeach
               </select>
           </td>
       </tr>
       <tr>
           <td colspan="2"  align="center"><input type="submit" value="表白"></td>
       </tr>
   </table>
</form>
</body>
</html>