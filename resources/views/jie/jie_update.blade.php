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
<form action="">
    <table align="center" >
        <tr>
            <td>用户名</td>
            <td><input type="text" name="name" class="name" id=""></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="pwd" class="pwd" id=""></td>
        </tr>
        <tr>
          
            <td><input type="button" class="aa" value="修改"></td>
        </tr>
    </table>
</form>
</body>
</html>
<script src="/admin/jquery.js"></script>
<script>
        var $url="{{url('api/restful')}}";
        var id =getQueryVariable('id');
        $.ajax({
            method: "GET",
            url: $url+'/'+id,

            dataType: "json",
            success: function (res) {
                $('.name').val(res.data.name);
                $('.pwd').val(res.data.pwd);
            }
        });

        $(Document).on('click','.aa',function () {

            var name = $('.name').val();
            var pwd = $('.pwd').val();
            $.ajax({
                method: "post",
                url:$url+'/'+id,
                data: {_method:'put',name:name,pwd:pwd},
                dataType: "json",
                success: function (res) {

                     if(res.code=='200'){
                         location.href='{{url('jie/list')}}';
                     }
                }
            })
        });




    function getQueryVariable(variable)
    {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
        }
        return(false);
    }
</script>