@extends('admin.layouts.common')

@section('title', '微信素材')

@section('body')
<form action="{{url('admin/sucai_do')}}" method="post" enctype="multipart/form-data">
    @csrf
    <select name="ooxx" id="">
        <option value="1">临时</option>
        <option value="2">永久</option>
    </select><br>
    图片:<input type="file" name="image" id=""><br>
    语音:<input type="file" name="voice" id=""><br>
    视频:<input type="file" name="video" id=""><br>
    缩略图<input type="file" name="thumb" id=""><br>
    <input type="submit" value="添加">

</form>

@endsection