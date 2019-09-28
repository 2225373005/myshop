@extends('acc.common')

@section('title', '分类属性')

@section('content')
    <table border="3" >
        <form action="{{url('acc/shu_add_do')}}" method="post">
            <table  border="3">
                <tr>
                    <td>属性名称</td>
                    <td><input type="text" name="anames" id=""></td>
                </tr>
                <tr>
                    <td>所属商品类型：</td>
                    <td>
                        <select name="tid" id="">
                            <option value="0">请选择</option>
                            @foreach($data as $v)
                            <option value="{{$v['tid']}}" @if($v['tid']==$cid) selected @endif>{{$v['tnames']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>属性是否可选</td>
                    <td>
                        <input type="radio" name="atype" checked value="1" id=""> 唯一属性
                        <input type="radio" name="atype" value="2" id="" > 单选属性
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="确定"></td>
                </tr>
            </table>
        </form>

    </table>

@endsection