<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台添加车次</title>
</head>
<body>
	<form action="{{url('che\add')}}" method="post" enctype="multipart/form-data">
	@csrf
       <table border="3">
          <tr>
          	<td>车次</td>
          	<td><input type="text" name="c_che" id=""></td>
          </tr>
          <tr>
          	<td>出发站</td>
          	<td><input type="text" name="c_chu" id=""></td>
          </tr>
          <tr>
          	<td>到达站</td>
          	<td><input type="text" name="c_dao" id=""></td>
          </tr>
          <tr>
          	<td>出发时间</td>
          	<td><input type="text" name="c_chutime" id=""></td>
          </tr>
          <tr>
          	<td>到达时间</td>
          	<td><input type="text" name="c_daotime" id=""></td>
          </tr>
          <tr>
          	<td>价格</td>
          	<td><input type="text" name="c_price" id=""></td>
          </tr>
          <tr>
          	<td>数量</td>
          	<td><input type="text" name="c_num" id=""></td>
          </tr>
     
          <tr>
          	<td><input type="submit" value="添加车票"></td>
          	<td></td>
          </tr>
       </table>
	</form>
</body>
</html>