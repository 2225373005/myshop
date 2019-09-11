<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>

    <table border="4" align="center">
        <tr>
            <td>用户名</td>
            <td><input type="text" name="name" id="" class="name"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td ><input type="password" name="pwd" id="" class="pwd"></td>
        </tr>
        <tr>
            <td  clospan="2"><input  type="button" class="aa" value="添加"></td>

        </tr>
    </table>

</body>
</html>
<script src="/admin/jquery.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $('.aa').click(function () {
        $url="{{url('api/restful')}}";
        var name = $('.name').val();
        var pwd = $('.pwd').val();
        $.ajax({
              method: "post",
              url: $url,
              data:{name:name,pwd:pwd},
              dataType: "json",
            success:function (res) {
                  // alert(111);
            if(res['code']==200){
                location.href='{{url('jie/list')}}';
            }

            }

        });

    })
</script>