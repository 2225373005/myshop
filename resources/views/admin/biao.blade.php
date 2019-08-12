@extends('admin.layouts.common')

@section('title', '微信素材')

@section('body')
    <form action="{{url('admin/biao_do')}}" method="post" enctype="multipart/form-data">
        @csrf
      <h3>创建用户标签</h3>
        <input type="text" name="name" id=""><br>
        <input type="submit" value="创建">

    </form>

@endsection