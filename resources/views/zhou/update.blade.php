@extends('layouts.commom')

@section('title', '用户展示')

@section('content')
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="names" id="names"></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="price" id="price"></td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td>
                <input type="file" name="file" id="files" >
                <img width="50" src="" alt="" id="file">
            </td>
        </tr>
        <tr>
            <td><input type="button" value="修改"></td>
            <td></td>
        </tr>
    </table>
    <script>
        var id =GetQueryString('id');
        $.ajax({
            url:'{{url('api/zhou')}}/'+id,

            dataType:'json',
            method:'get',
            success:function (res) {

                 if(res.code==200){

                     $('#names').val(res.data.names);
                     $('#price').val(res.data.price);

                     $('#file').prop('src','/storage/'+res.data.file);
                 }
            }
            
        });

        $('[type="button"]').on('click',function () {
            var names=$('#names').val();
            var price=$('#price').val();
            var file = document.getElementById("files").files[0];
            var formData = new FormData();
            formData.append('names', names);
            formData.append('price', price);
            formData.append('file', file);
            formData.append('_method','put');
            $.ajax({
                url: "{{url('api/zhou')}}/"+id,
                type: "post",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                mimeType: "multipart/form-data",
                success: function (data) {
                    // alert(data.msg);
                    if(data.code==200){
                        location.href="{{url('/zhou/list')}}";
                    }
                },

            });
        });


        function GetQueryString(name)
        {
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r!=null)return  unescape(r[2]); return null;
        }
    </script>
@endsection