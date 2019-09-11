<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
      <table border="5">
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
              <td><input type="file" name="file" id="file"></td>

          </tr>
          <tr>
              <td><input type="button" value="添加"></td>
              <td></td>
          </tr>
      </table>
</body>
</html>
<script src="/admin/jquery.js"></script>
<script>
     $('[type="button"]').on('click',function () {
         var names=$('#names').val();
         var price=$('#price').val();
         var file = document.getElementById("file").files[0];
         var formData = new FormData();
         formData.append('names', names);
         formData.append('price', price);
         formData.append('file', file);
         $.ajax({
             url: "{{url('api/zhou')}}",
             type: "post",
             dataType: "json",
             data: formData,
             contentType: false,
             processData: false,
             mimeType: "multipart/form-data",
             success: function (data) {
                // alert(data.msg);
                 if(data.code==200){
                     location.href="{{url('zhou/list')}}";
                 }
             },

         });

         // console.log(formData);
         // alert(file);

     })
</script>