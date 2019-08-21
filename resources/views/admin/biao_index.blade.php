@extends('admin.layouts.common')
@section('title','微信表白')
@section('body')
    <form action="{{url('admin/biao_add')}}" method="post">
        @csrf
        <select name="yi" id="">
            <option value="">请选择</option>
            <option value="1">一级菜单</option>
            <option value="2">二级菜单</option>
        </select><br>
        一级菜单: <input type="text" name="name" id=""><br>
        二级菜单: <input type="text" name="names" id=""><br>
        菜单标识: <input type="text" name="view" id=""><br>
        <select name="type" id="">
            <option value="">请选择</option>
            <option value="click">click</option>
            <option value="view">view</option>
        </select><br>
        <input type="submit" value="添加">
    </form>
@endsection