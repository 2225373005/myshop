@extends('acc.common')

@section('title', '分类属性')

@section('content')
    <form action="{{url('acc/huo_list')}}" method="get">
        <select name="cid" id="">
            <option value="">所有分类</option>
            @foreach($xxoo as $v)
                <option value="{{$v['cid']}}" @if($cid==$v['cid'] ) selected @endif ><?php echo str_repeat('&nbsp;',$v['path'])?>{{$v['cnames']}}</option>
            @endforeach
        </select>
        <select name="c_show" id="">
            <option value="">是否上下架</option>
            <option value="1"  @if($c_show=='1') selected @endif>上架</option>
            <option value="0" @if($c_show=='0') selected @endif>下架</option>
        </select>
       关键字搜索 <input type="text" name="g_name" value="{{$g_name}}" id="">
        <input type="submit" value="搜索">
    </form>

    <table border="3">
        <tr>
            <td>全选 <input type="checkbox" name="" id="ttoo"></td>
            <td>编号</td>
            <td>商品名称</td>
            <td>分类</td>
            <td>货号</td>
            <td>价格</td>
            <td>图片</td>
            <td>上架</td>
            <td>操作</td>
        </tr>
        @foreach($info as $v)
        <tr>
            <td><input type="checkbox" name="check[]" id="" ></td>
            <td>{{$v['g_id']}}</td>
            <td class="hhh" g_id="{{$v['g_id']}}">{{$v['g_name']}}</td>
            <td><span class="up">{{$v['cnames']}}</span></td>
            <td>k278</td>
            <td>{{$v['g_price']}}</td>
            <td><img src="{{$v['g_img']}}" alt=""></td>
            @if($v['cshow']==1)
            <td>上架</td>
            @else
                <td>下架</td>
            @endif
            <td><a href="">修改</a></td>
        </tr>

        @endforeach
        <tr height="20">
            <td colspan="9" align="center">
                {{ $info->appends(['g_name' =>$g_name,'c_show'=>$c_show,'cid'=>$cid])->links() }}
            </td>
        </tr>
    </table>
    <script src="/admin/jquery.js"></script>
    <script>

        $(document).on('click','.hhh',function () {
                // alert(22);
            var g_id=$(this).attr('g_id');
            var name=$(this).text();
            if(name!=''){
                $(this).html("<input type='text' class='fo' value='" + name + "'/>");
                $(".fo").focus(); //光标
                $(".fo").blur(function(){
                    //获取到修改后的值
                    var val = $(".fo").val();
                    //
                    /*
                    将所有修改信息传到后端
                     */
                    $(this).parent().html("<span class='up' style='cursor:pointer;'>"+val+"</span>");
                    var aa=$(this).val();
                    $.ajax({
                       url:'{{url('acc/huo_dian')}}',
                       data:{name:aa,g_id:g_id},
                       method:'post',
                       dataType:'json',
                       success:function (res) {
                           if(res.code==200){
                               alert('修改成功');
                           }

                       }

                    });
                    // alert(g_id);
                    // alert(aa);

                })
            }
            // alert(name);

            // $(":text").select();
            // $(this).focus();
            // alert(name);
        });
        // //即点即改
        // $(document).on("click",".up",function(){
        //     var content = $(this).text(); //获取到当前点击对象的值
        //     var pid = $(this).parents("tr").attr('pid');  //通过attr 获取到设置的属性（pid）
        //     //当点击修改文字时 变成文本框并且获取到原值（content）
        //     $(this).parent().html("<input type='text' class='fo' value='" + content + "'/>");
        //     $(".fo").focus(); //光标
        //     $(".fo").blur(function(){
        //         //获取到修改后的值
        //         var val = $(".fo").val();
        //         //
        //         /*
        //         将所有修改信息传到后端
        //          */
        //         $(this).parent().html("<span class='up' style='cursor:pointer;'>"+val+"</span>");
        //     })
        // })
    </script>
@endsection