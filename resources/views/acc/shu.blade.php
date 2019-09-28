@extends('acc.common')

@section('title', '分类属性')

@section('content')
        <table border="3">
            <tr>
                <td>类型名</td>
                <td>属性数</td>
                <td>操作</td>
            </tr>
            @foreach($data as $v)
            <tr>
                <td>{{$v['tnames']}}</td>
                <td>{{$v['num']}}</td>
                <td><a href="{{url('acc/shu_list')}}?id={{$v['tid']}}">属性列表</a></td>
            </tr>
            @endforeach
        </table>
        
@endsection