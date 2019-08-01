<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车票</title>
</head>
<body>
	<form action="{{url('che/save')}}" method="post">
	@csrf
       <table border="3">
           <tr>
           	<td>车次</td>
           	<td>
               <select name="c_id">
                 @foreach($info as $v)
                   <option value="{{$v->c_id}}">{{$v->c_che}}</option>
             	 @endforeach
               </select>
           	</td>
           </tr>
           <tr>
           	<td>座</td>
           	<td>
               <select name="b_zuo">
                   <option value="1">商务座</option>
                   <option value="2">一等座</option>
                   <option value="3">二等座</option>
                   <option value="4">无座座</option>
               </select>
           	</td>
           </tr>

           <tr>
           	<td>数目</td>
           	<td><input type="text" name="b_num" id=""></td>
           </tr>
           <tr>
           	<td>价格</td>
           	<td><input type="text" name="b_price" id=""></td>
           </tr>
           <tr>
           	<td><input type="submit" value="添加"></td>
           	<td></td>
           </tr>
       </table>
	</form>
</body>
</html>