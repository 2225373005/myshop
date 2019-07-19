@extends('admin.layouts.common')

@section('title', '主题')

@section('body')
<table border="2">
    页面访问量{{$num}}</br>
    <form action="{{url('admin/list_goods')}}" method="get">
        <input type="text" name="goods_name" value={{$goods_name}}>
        <input type="submit" value="搜索">
    </form>
   <tr>
   	<td>ID</td>
   	<td>商品名称</td>
   	<td>LOG</td>
   	<td>商品价格</td>
   	<td>商品库存</td>
   	<td>是否上架</td>
   	<td>添加时间</td>
   	<td>操作</td>
   </tr>
    @foreach ($model as $user)
   <tr>
    <td>{{ $user->goods_id }}</td>
   	<td>{{ $user->goods_name }}</td>
   	<td><img width="50" src="{{ asset('storage').'/'.$user->goods_pic }}" alt=""></td>
   	<td>{{ $user->goods_price }}</td>
   	<td>{{ $user->goods_num }}</td>
   	<td>{{ $user->goods_up }}</td>
   	<td>{{ $user->add_time }}</td>
   	<td><a href="">删除</a>|<a href="{{url('admin/update')}}?goods_id={{ $user->goods_id}}">修改</a></td>
   </tr>
@endforeach
<tr>
    <td colspan="8">
     {{ $model->appends(['goods_name' =>$goods_name])->links() }}
    </td>
</tr>
</table>





@endsection