
@extends('layouts.commom')

@section('title', '用户展示')



@section('content')
<div align="center">


     <form>
        用户名:<input type="text" name="name" class="pp" id="">
        <input type="button" class="sou btn btn-primary" value="搜索">
    </form>

 </div>

    <table class="table table-bordered table-hover">


        <tr > <td>用户名</td> <td>密码</td> <td>操作</td> </tr>
    <tbody class="aa">

    </tbody>

    <div align="center">
        <ul class="eee pagination">
        </ul>
    </div>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    var url="{{url('api/restful')}}";
    //获取文本矿值
    var name= $('.pp').val();

        $(document).ready(function () {

            //任何需要执行的js特效
            // alert(22);
            $.ajax({
                method: "get",
                url: url,
                data:{name:name},
                dataType: "json",
                success: function (res) {


                    // alert(res.data.last_page);
                        pppp(res);

                }
            });
          //点击分页
            $(Document).on('click','.eee a',function () {

                var page= $(this).attr('pageid');
                // alert(page);
                var name= $('.pp').val();

                $.ajax({
                    method: "get",
                    data:{name:name,page:page},
                    url: url,
                    dataType: "json",
                    success: function (res) {
               
                       pppp(res);

                    }
                })
                // alert(name);
            });


            $(Document).on('click','.sou',function () {
                var ll=1;
                var name= $('.pp').val();

               // alert(name);
                $.ajax({
                    method: "get",
                    data:{name:name},
                    url: url,
                    dataType: "json",
                    success: function (res) {
             
                     pppp(res)


                    }
                })
               // alert(name);
            });


            $(Document).on('click','.delete',function () {
                alert(11);
                var _this = $(this);
                var id=_this.attr('delid');
                $.ajax({
                    method: "post",
                    data:{_method:'DELETE'},
                    url: $url+'/'+id,
                    dataType: "json",
                    success: function (res) {
                     alert(res);

                    }
                })
            });

            $(Document).on('click','.xxoo',function () {
                // alert(11);
                var _this=$(this);
                var id=_this.attr('upid');
                $.ajax({
                    success: function () {
                        location.href='{{url("/jie/update")}}?id='+id;
                    }
                })
            })
        });




            function pppp(res){

                 $('.aa').children().replaceWith('');
                    $.each(res.data.data, function (i, v) {

                        var tr = ('<tr></tr>');

                        $('.aa').append(' <tr> <td>' + v['name'] + '</td> <td>' + v['pwd'] + '</td> <td><button class="delete btn btn-danger" delid="' + v['id'] + ' "> 删除</button>||<button class="xxoo btn btn-info" upid="' + v['id'] + '">修改</button></td> </tr>');
                        // console.log(v['name']);
                    });
                     var page="";
                            for ( var i=1;i<=res.data.last_page;i++){
                                page +='<li><a href="javascript:;"  pageid="'+i+'">第'+i+'页</a></li>';
                                // alert(page);
                            }
                      $('.eee').append().html(page);
          }

</script>
@endsection




