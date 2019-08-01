<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('koo/add_do')}}" method="post" enctype="multipart/form-data">
	@csrf
	<table>
       <tr>
       	<td>标题</td>
       	<td><input type="text" name="x_title" id=""></td>
       </tr>
       <tr>
       	<td>新闻图片</td>
       	<td><input type="file" name="x_file" id=""></td>
       </tr>
       <tr>
       	<td>新闻作者</td>
       	<td><input type="text" name="x_name" id=""></td>
       </tr>
       <tr>
       	<td>新闻内容</td>
       	<td><textarea name="x_content" id="" cols="30" rows="10"></textarea></td>
       </tr>
       <tr>
       	<td></td>
       	<td><input type="submit" value="添加"></td>
       </tr>
   </table>
	</form>
</body>
</html>