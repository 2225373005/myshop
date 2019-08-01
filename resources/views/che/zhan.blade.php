<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>展示</title>
</head>
<body>
   <form action="{{url('che/zhan')}}" >
       出发地  <input type="text" name="c_chu" value="{{$c_chu}}" id="">
       目的地  <input type="text" name="c_dao" value="{{$c_dao}}" id="">
       <input type="submit" value="搜索">
   </form>
  

	<table border="2">
       <tr>
       	<td>车次</td>
       	<td>出发站</td>
       	<td>到达站</td>
       	<td>出发时间</td>
       	<td>到达时间</td>
       	<td>历时</td>
       	<td>商务座</td>
       	<td>一等座</td>
       	<td>二等座</td>
       	<td>无座</td>
       	<td>价格</td>
       	<td>数量</td>
       	<td>备注</td>
       </tr>
       @foreach($info as $v)
	       <tr>
		       	<td>{{$v->c_che}}</td>
		       	<td>{{$v->c_chu}}</td>
		       	<td>{{$v->c_dao}}</td>
		       	<td>{{date('Y-m-d H:i:s',$v->c_chutime)}}</td>
		       	<td>{{date('Y-m-d H:i:s',$v->c_daotime)}}</td>
		       	<td></td>
		       	<td></td>
		       	<td></td>
		       	<td></td>
		       	<td></td>
		       	<td>{{$v->c_price}}</td>
		        <td>
		        @if($v->c_num>100)
                     有
		        @elseif($v->c_num>0)
                   {{$v->c_num}}
		        @else
                   无
		        @endif
		       

		        </td>
		       	<td>
		       	@if($v->c_num>0)
		       	<button>预定</button>
		       	@else
        			预定
		       	@endif
		       	</td>
	       </tr>
       @endforeach
	</table>
</body>
</html>