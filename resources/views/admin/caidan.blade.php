@extends('admin.layouts.common')

@section('title', '微信菜单添加')

@section('body')
    <form action="{{url('admin/caidan_do')}}" method="post">

        @csrf
        一级菜单: <input type="text" name="name" id=""><br>
        请选择类型:<select name="type" id="">
                        <option value="">请选择</option>
                        <option value="click">click</option>
                        <option value="event">event</option>
                  </select><br>
        
        子菜单 :  <select name="zi" id="">
                        <option value="">请选择一级菜单</option>
                        @foreach($data as $v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                  </select><br>
        
        二级菜单: <input type="text" name="names" id=""><br>
        菜单标识(标识或url): <input type="text" name="url" id="">
        <input type="submit" value="添加">

    </form>
@endsection