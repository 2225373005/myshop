@extends('acc.common')

@section('title', '分类添加')


@section('content')
    <form action="{{url('acc/category_add')}}" method="post" id="kkk" >
        <table border="4">
            <tr>
                <td>分类名称</td>
                <td><input type="text" name="cnames" id="cnames"><span id="pan"></span></td>
            </tr>
            <tr>
                <td>顶级分类</td>
                <td>
                    <select name="ctype" id="">
                        <option value="0">请选择</option>
                        @foreach($data as $v)
                            <option value="{{$v['cid']}}"><?php echo str_repeat("&nbsp;",$v['path']); ?>{{$v['cnames']}}</option>
                        @endforeach

                    </select>
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" name="cshow" value="1" id="">是
                    <input type="radio" checked name="cshow" value="0" id="">否
                </td>
            </tr>
            <tr>
                <td>是否排序</td>
                <td>
                    <input type="radio" name="cpaixu" value="1" id="">是
                    <input type="radio" checked name="cpaixu" value="0" id="">否
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="添加"></td>
            </tr>
        </table>
    </form>
    <script src="/admin/jquery.js"></script>
    <script>
        var fal=false;
        $('#cnames').on('blur',function () {
            var cnames=$('#cnames').val();
            $.ajax({
                url:'{{url('acc/yan')}}',
                data:{cnames:cnames},
                method:'post',
                dataType:'json',
                success:function (res) {
                   if(res.code==0){
                        $('#pan').html('<b>此分类名已存在</b>');
                        return false;
                   }else{
                       $('#pan').html('<b></b>');
                       fal=true;
                   }

                }
            })
        });
        $('[type="button"]').on('click',function(){
            if(fal){
                    $('#kkk').submit();
            }
        })


    </script>


@endsection