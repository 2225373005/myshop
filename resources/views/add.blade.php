<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加</title>
</head>
<body>
	<form action="{{url('user/add_do')}}" method="post">
	@csrf
       <table>
       @if ($errors->any())

            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach

@endif
           <tr>
           	<td>用户名</td>
           	<td><input type="text" name="name" id=""></td>
           </tr>
           <tr>
           	<td>年龄</td>
           	<td><input type="text" name="age" id=""></td>
           </tr>
           <tr>
           	<td><input type="submit" value="添加"></td>
           	<td></td>
           </tr>
       </table>
	</form>
</body>
</html>