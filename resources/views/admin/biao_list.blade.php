@extends('admin.layouts.common')

@section('title', '微信素材')

@section('body')
  <table border="4">
      <h3><a href="{{url('admin/biao')}}">添加标签</a></h3>
      <tr>
          <td>id</td>
          <td>标签名称</td>
          <td>标签下的粉丝数</td>
          <td>操作</td>
      </tr>
      @foreach($data['tags'] as $v)
      <tr>
          <td>{{$v['id']}}</td>
          <td>{{$v['name']}}</td>
          <td>{{$v['count']}}</td>
          <td><a href="{{url('admin/biao_del')}}?id={{$v['id']}}">删除</a>|<a href="{{url('admin/biao_update')}}?id={{$v['id']}}">修改</a> | <a href="{{url('admin/biao_fei')}}?id={{$v['id']}}">粉丝列表</a> | <a href="{{url('admin/biao_da')}}?id={{$v['id']}}">为粉丝打标签</a>|<a
                      href="{{url('admin/biao_song')}}?id={{$v['id']}}">根据标签发送消息</a></td>
      </tr>
      @endforeach

  </table>

@endsection