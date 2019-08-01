<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加调研项目</title>
</head>
<body>
	<form action="{{url('kao/bbb_do')}}" method="post" >
	@csrf
        调研项目: <input type="text" name="title" id=""><br>
        <input type="submit" value="添加调研">	
	</form>
</body>
</html>