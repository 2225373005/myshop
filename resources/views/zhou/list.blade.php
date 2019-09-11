@extends('layouts.commom')

@section('title', '用户展示')

@section('content')
    <div align="center">
        <input type="text" name="sou" id="sou">
        <input type="button" class="btn btn-lg btn-primary" value="搜索">
    </div>
    <table class="table table-bordered table-hover">
        <tr>
            <td>商品名称</td>
            <td>商品价格</td>
            <td>商品图片</td>
            <td>操作</td>
        </tr>
        <tbody class="aaa">

        </tbody>

    </table>
    <script>

          $(document).ready(function () {
              var sou= $('#sou').val('');
              // alert(11);
              $.ajax({
                  url:'{{url('api/zhou')}}',
                  method:'get',
                  dataType:'json',
                  success:function (res) {
                        // console.log(res.code);
                        $.each(res.data.data,function (i,v) {
                            var tr=$('<tr></tr>');
                            tr.append('<td>'+v.names+'</td>');
                            tr.append('<td>'+v.price+ '</td>');
                            tr.append('<td><img width="50" src="/storage/'+v.file+ '" alt=""></td>');
                            tr.append('<td><a href="javascript:;" class="delete"  delid="'+v.id+'">删除</a>||<a href="javascript:;" class="update" upid="'+v.id+'">修改</a></td>');
                            $('.aaa').append(tr);
                        });
                      var div=$('<div align="center" class="xxoo" ></div>');
                      for (var i=1;i<=res.data.last_page;i++){
                            div.append('<b><a href="javascript:;" pageid="'+i+'" >第'+i+'页</a></b>');
                          $('.aaa').after(div);

                      }
                  }
                  
              })
          });
          $(Document).on('click','.xxoo a',function () {
               var sou= $('#sou').val();
                 var pageid = $(this).attr('pageid');
                 $.ajax({
                     url:'{{url('api/zhou')}}',
                     data:{page:pageid,sou:sou},
                     method:'get',
                     dataType: 'json',
                     success:function (res) {
                         page(res);
                     }
                 })
          });
          //修改
          $(Document).on('click','.update',function () {
                   var id=$(this).attr('upid');
              $.ajax({

                  success:function () {
                     location.href='{{url('/zhou/update')}}?id='+id;
                  }
              })
          });
          //删除
          $(Document).on('click','.delete',function () {
              var _this=$(this);
              var id=_this.attr('delid');
              var img = _this.parents('tr').find('img').prop('src');
              // alert(img);
              $.ajax({
                  url:'{{url('api/zhou')}}/'+id,
                  data:{_method:'delete',img:img},
                  method:'post',
                  dataType: 'json',
                  success:function (res) {
                      if(res.code==200){
                          _this.parents('tr').hide();
                      }
                  }
              })
          });
         $(Document).on('click','[type="button"]',function () {
               var sou= $('#sou').val();
              $.ajax({
                  url:"{{url('api/zhou')}}",
                  data:{sou:sou},
                  method:'get',
                  dataType: 'json',
                  success:function (res) {
                       page(res);
                   }
              })
         });

         function page(res){
             $('.aaa').empty();
             $('.xxoo').empty();
             $.each(res.data.data,function (i,v) {
                 var tr=$('<tr></tr>');
                 tr.append('<td>'+v.names+'</td>');
                 tr.append('<td>'+v.price+ '</td>');
                 tr.append('<td><img width="50" src="/storage/'+v.file+ '" alt=""></td>');
                 tr.append('<td><a href="javascript:;" class="delete"  delid="'+v.id+'">删除</a>||<a href="javascript:;" class="update" upid="'+v.id+'">修改</a></td>');
                 $('.aaa').append(tr);
             });
             var div=$('<div align="center" class="xxoo" ></div>');
             for (var i=1;i<=res.data.last_page;i++){
                 div.append('<b><a href="javascript:;" pageid="'+i+'" >第'+i+'页</a></b>');
                 $('.aaa').after(div);

             }
          }
    </script>
@endsection