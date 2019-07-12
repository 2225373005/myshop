<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件上传</title>
</head>
<body>
	<form action="{{url('index/add_goods_do')}}" method="post" enctype="multipart/form-data">
	@csrf
       <table>
           <input type="file" name="goods_pic" id="">
           <input type="submit" value="上传">
       </table>
	</form>
</body>
</html>