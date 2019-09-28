@extends('acc.common')

@section('content')

{{--    <link href="{{asset('/bootstrap/bootstrap.min.css')}}" rel="stylesheet">--}}
    <script src="{{asset('/bootstrap/bootstrap.min.js')}}"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="{{asset('/bootstrap/jquery.min.js')}}"></script>
<div class="container">
    <h3>商品添加</h3>
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="javascript:;" name='basic'>基本信息</a></li>
        <li role="presentation" ><a href="javascript:;" name='attr'>商品属性</a></li>
        <li role="presentation" ><a href="javascript:;" name='detail'>商品详情</a></li>
    </ul>
    <br>
    <form action='{{url('acc/shop_add')}}' method="POST" enctype="multipart/form-data" id='form'>

        <div class='div_basic div_form'>
            <div class="form-group">
                <label for="exampleInputEmail1">商品名称</label>
                <input type="text" class="form-control" name='g_name'>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">商品分类</label>
                <select class="form-control" name='cat_id'>
                    <option value='0'>请选择</option>
                    @foreach($info as $v)
                        <option value='{{$v['cid']}}'><?php echo str_repeat('&nbsp;',$v['path'])  ?>{{$v['cnames']}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">商品货号</label>
                <input type="text" class="form-control" name=''>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">商品价钱</label>
                <input type="text" class="form-control" name='g_price'>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">商品图片</label>
                <input type="file" name='g_img'>
            </div>
        </div>
        <div class='div_detail div_form' style='display:none'>
            <div class="form-group">
                <label for="exampleInputFile">商品详情</label>
                <textarea name="g_content" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <div class='div_attr div_form' style='display:none'>
            <div class="form-group">
                <label for="exampleInputEmail1">商品类型</label>
                <select class="form-control ppp"  name='a_id' >
                    <option value="0" selected>请选择</option>
                    @foreach($data as $v)
                        <option value="{{$v['tid']}}">{{$v['tnames']}}</option>
                    @endforeach
                </select>
            </div>
            <script src="/admin/jquery.js"></script>

            <script>

                $('select').prop('selectedIndex', 0);
                $('.ppp').on('change',function () {
                    var select=$(this).val();
                    // alert(select);
                    $.ajax({
                        url:'{{url('acc/shop_select')}}',
                        data:{select:select},
                        dataType:'json',
                        method:'get',
                        async:'true',
                        success:function (res) {
                            $('#attrTable').empty();
                            $.each(res.data,function (i,v) {
                                var tr =$('<tr></tr>');
                                if(v.atype==1){
                                    tr.append('<td><input type="hidden" name="a_id[]" value="'+v.aid+'">'+v.anames+'</td>');
                                    tr.append('<td><input type="text" name="attr_name[]" id=""> <input type="hidden" name="attr_price[]" ></td>');
                                }
                                if(v.atype==2){
                                    tr.append('<td><a class="bbb" href="javascript:;">[+]</a><input type="hidden" name="a_id[]" value="'+v.aid+'">'+v.anames+'</td>');
                                    tr.append('<td><input type="text" name="attr_name[]" id="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;属性价格&nbsp;&nbsp;<input type="text" name="attr_price[]" id=""></td>');
                                }
                                $('#attrTable').append(tr);
                            })
                        }
                    });
                });
                $(document).on('click','.bbb',function () {
                    var aaa=$(this).html();
                    if(aaa=='[+]'){
                           var tr=$(this).html('[-]').parents('tr').clone();
                           var _this=$(this).html('[+]');
                           // alert(_this);
                            $('#attrTable').append(tr);
                }
                    if(aaa=='[-]'){
                        var tr=$(this).parents('tr').remove();

                    }
                })

            </script>
            <br>

            <table width="100%" id="attrTable" class='table table-bordered'>
{{--                <tr>--}}
{{--                    <td>前置摄像头</td>--}}
{{--                    <td>--}}
{{--                        <input type="hidden" name="attr_id_list[]" value="211">--}}
{{--                        <input name="attr_value_list[]" type="text" value="" size="20">--}}
{{--                        <input type="hidden" name="attr_price_list[]" value="0">--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><a href="javascript:;">[+]</a>颜色</td>--}}
{{--                    <td>--}}
{{--                        <input type="hidden" name="attr_id_list[]" value="214">--}}
{{--                        <input name="attr_value_list[]" type="text" value="" size="20">--}}
{{--                        属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">--}}
{{--                    </td>--}}
{{--                </tr>--}}
            </table>
            <!-- <div class="form-group">
                    颜色:
                    <input type="text" name='attr_value_list[]'>
            </div> -->
            <!-- <div class="form-group" style='padding-left:26px'>
                <a href="javascript:;">[+]</a>内存:
                <input type="text" name='attr_value_list[]'>
                属性价格:<input type="text" name='attr_price_list[][]'>
            </div> -->

        </div>

        <button type="submit" class="btn btn-default" id='btn'>添加</button>
    </form>
</div>
    <script type="text/javascript">
        //标签页 页面渲染
        $(".nav-tabs a").on("click",function(){
            $(this).parent().siblings('li').removeClass('active');
            $(this).parent().addClass('active');
            var name = $(this).attr('name');  // attr basic
            $(".div_form").hide();
            $(".div_"+name).show();  // $(".div_"+name)
        })
    </script>
@endsection