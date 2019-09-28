@extends('acc.common')

@section('title', '添加货品')

@section('content')
    {{--    <link href="{{asset('/bootstrap/bootstrap.min.css')}}" rel="stylesheet">--}}
    <script src="{{asset('/bootstrap/bootstrap.min.js')}}"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="{{asset('/bootstrap/jquery.min.js')}}"></script>

    <div class="container">


    <h3>货品添加</h3>
        <form action="{{url('acc/huo_add')}}" method="post">
            <input type="hidden" name="id" value="{{$id}}">
    <table width="100%" id="table_list" class='table table-bordered'>
        <tbody>
        <tr>
            <th colspan="20" scope="col">商品名称：{{$data['g_name']}}&nbsp;&nbsp;&nbsp;&nbsp;货号：111</th>
        </tr>

        <tr>
            <!-- start for specifications -->
            @foreach($xxoo as $k=>$v)
            <td scope="col"><div align="center"><strong>{{$k}}</strong></div></td>

            @endforeach
            <!-- end for specifications -->
            <td class="label_2">货号</td>
            <td class="label_2">库存</td>
            <td class="label_2">&nbsp;</td>
        </tr>

        <tr id="attr_row">
            <!-- start for specifications_value -->
            @foreach($xxoo as $k=>$v)
            <td align="center" style="background-color: rgb(255, 255, 255);">
                <select name="select[]">
                    <option value="" selected="">请选择...</option>
                    @foreach($v as $vv)
                    <option value="{{$vv}}">{{$vv}}</option>
                    @endforeach
                </select>
            </td>
            @endforeach
            <!-- end for specifications_value -->
            <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
            <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
            <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button yyy" value="+" ></td>
        </tr>

        <tr>
            <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
                <input type="submit" class="button" value=" 保存 ">
            </td>
        </tr>
        </tbody>
    </table>
        </form>
    </div>
    <script src="/admin/jquery.js"></script>
    <script>
        $(document).on('click','.yyy',function () {

            var aa = $(this).val();
            var _this=$(this);
            // alert(111);
            if(aa=='+'){
                 _this.val('-');
                var tr = _this.parent().parent().clone();
                $('#attr_row').after(tr);
                _this.val('+');
            }
            // alert(aa);
            if(aa=='-'){
                $(this).parent().parent().remove();
            }

        })
    </script>

@endsection