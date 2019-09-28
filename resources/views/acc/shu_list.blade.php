@extends('acc.common')

@section('title', '分类属性')

@section('content')
    <div>
        <a href="{{url('acc/shu_add')}}?id={{$cid}}" class="btn btn-info">
            添加属相
        </a>
    </div>
    <div>
        <select name="tid" id="" class="ppp" >
            <option value="0">所有商品类型</option>
            @foreach($data as $v)

                <option value="{{$v['tid']}}" @if($v['tid']==$cid) selected @endif>{{$v['tnames']}}</option>
            @endforeach
        </select>
    </div>
    <table border="3">
        <tr>
            <td>全选&nbsp;&nbsp; <input type="checkbox" name='' id="check">&nbsp;&nbsp;反选&nbsp;&nbsp; <input type="checkbox" name='' id="fan"></td>
            <td>属性名称</td>
            <td>商品类型</td>
        </tr>
       <tbody  id="xxoo">
        @foreach($info as $v)
            <tr>
                <td>&nbsp;&nbsp; <input type="checkbox" name='che[]' ida="{{$v['aid']}}" class="ooxx" id="">&nbsp;&nbsp; {{$v['aid']}}</td>
                <td>{{$v['anames']}}</td>
                <td>{{$v['tnames']}}</td>

            </tr>
        @endforeach
        </tbody>
        <tr>
            <td colspan="3"><a class="delete" href="javascript:;">删除</a></td>



        </tr>
    </table>
    <script src="/admin/jquery.js"></script>
    <script>
         $('.ppp').on('change',function () {
             var select=$(this).val();
            $.ajax({
               url:'{{url('acc/select')}}',
               data:{select:select},
                dataType:'json',
                method:'get',
                async:'true',
                success:function (res) {
                    $('#xxoo').empty();
                   $.each(res.info,function (i,v) {
                       // alert(v.aid);
                       var tr= $('<tr></tr>');
                       tr.append('<td>'+v.aid+'</td>');
                       tr.append('<td>'+v.anames+'</td>');
                       tr.append('<td>'+v.tnames+'</td>');
                       $('#xxoo').append(tr);

                   })
                }
            });
         });

        $('#check').on('click',function () {
            // alert(222);
            var check=$(this).prop('checked');

            var bb=$('.ooxx').prop('checked',check);
            // alert(bb.length);

            // alert(check);
        });
        $('#fan').on('click',function () {

            $("#xxoo td :checkbox").each(function(){
                // alert(22);
                //遍历所有复选框，然后取值进行 !非操作
                $(this).prop("checked", !$(this).prop("checked"));
            })

        });
         var array = new Array();

        $('.delete').on('click',function () {
                // alert(22);
                $('#xxoo td :checkbox').each(function () {
                    // alert(11);
                    // alert($(this).prop("checked"));
                        if($(this).prop("checked")){
                            // alert(22);
                            var aid=$(this).attr('ida');
                            // alert(aid);
                            $(this).parent().parent().remove();
                            array.push(aid);
                        }
                });
                $.ajax({
                    url:'{{url('acc/shu_delete')}}',
                    data:{name:array},
                    dataType:'json',
                    method:'post',
                    success:function (res) {
                        // dd(res);
                        // alert(22);
                        if(res.code==200){
                            array.length = 0;
                        }
                    }
                });
            alert(array);
        })


    </script>
@endsection