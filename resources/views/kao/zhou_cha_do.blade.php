<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>获取添加</title>
</head>
<body>
<table border="4">
    <tr>
        <td>城市</td>
        <td>星期几 </td>
        <td>温度</td>
        <td>天气</td>
        <td>风向</td>
        <td>风速</td>
    </tr>
    <tbody id='aa'></tbody>
</table>
</body>
</html>
<script src="/admin/jquery.js"></script>
<script>
    $.ajax({
        'url':'http://www.myshop.com/kao/cha',
        'method':'get',
        'dataType':'json',
        success:function (res) {
            // alert(res);
            $.each(res,function (i,v) {
                var tr =$('<tr></tr>');
                tr.append('<td>'+v.citynm+'</td>');
                tr.append('<td>'+v.week+'</td>');
                tr.append('<td>'+v.temperature+'</td>');
                tr.append('<td>'+v.weather+'</td>');
                tr.append('<td>'+v.wind+'</td>');
                tr.append('<td>'+v.winp+'</td>');
                $('#aa').append(tr);
            })
        }
    })
</script>