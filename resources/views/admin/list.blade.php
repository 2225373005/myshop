@extends('admin.layouts.common')

@section('title', '微信素材')

@section('body')
    <form action="{{url('admin/sucai_do')}}" method="post" enctype="multipart/form-data">
        @csrf


    </form>

@endsection