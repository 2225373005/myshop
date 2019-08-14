@extends('admin.layouts.common')

@section('title', '主题')

@section('body')

<table border="4">
    <tr>
        <td>id</td>
        <td>用户名</td>
        <td>用户管理</td>
        <td>生成永久二微码</td>
        <td>专属二维码链接</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->state}}</td>
        <td>
            @if($v->agent_code)
                <img src="{{$v->agent_code}}" alt="" width="50">
            @else
                <a href="{{url('admin/err')}}?id={{$v->id}}">生成永久二微码</a>
            @endif
        </td>
        <td>
            @if($v->qrcode)
                <a href="{{url('admin/wo')}}?id={{$v->id}}">专属二维码链接</a>
            @else
               没有链接
            @endif
        </td>
    </tr>
    @endforeach

</table>
@endsection