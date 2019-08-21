@extends('admin.layouts.common')
@section('title', '微信菜单展示')
@section('body')
    <center><h3>菜单展示</h3></center>
<table border="4" align="center">
    <tr>
        <td>id</td>
        <td>一级菜单</td>
        <td>二级菜单</td>
        <td>事件类型</td>
        <td>菜单标识</td>
        <td>操作</td>
    </tr>
    @foreach($info as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->names}}</td>
        <td>{{$v->type}}</td>
        <td>{{$v->url}}</td>
        <td><a href="">删除</a></td>
    </tr>
    @endforeach

</table>

@endsection
