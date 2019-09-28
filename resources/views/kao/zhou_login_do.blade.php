<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
</head>
<body>
        <table id="deng">
            <tr>
                <td>用户名</td>
                <td><input type="text" name="name" id="name"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="pwd" id="pwd"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="登录"></td>
            </tr>
        </table>
</body>
</html>
<script src="/admin/jquery.js"></script>
<script>
    $('[type="button"]').on('click',function () {
        var name = $('#name').val();
        var pwd = $('#pwd').val();
        $.ajax({
            'url':'http://www.myshop.com/kao/zhou_login',
            'data':{name:name,pwd:pwd},
            'dataType':'json',
            'method':'get',
            success:function (res) {
                if(res.code==200){
                    location.href="{{url('kao/zhou_cha_do')}}?token="+res.token+"";
                    // alert(res.token);
                }
            }
        })
    })

</script>