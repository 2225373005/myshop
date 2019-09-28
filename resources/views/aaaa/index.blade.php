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

<form action="{{url('aaaa/index')}}" method='get'>
    <table>
        <tr>
            <td>请求地址:</td>
            <td><input type="text" name="url" id="url"></td>
        </tr>
        <tr>
            <td>请求方式</td>
            <td><input type="radio" name="xxoo" value="get" id="">get <input type="radio"  name="xxoo" value="post" id="">post</td>
        </tr>
        <tr>
            <td>参数名称: <input type="text" name="names[]" id=""></td>
            <td>参数值: <input type="text" name="can[]" id=""></td>
        </tr>
        <tr id="llll">
            <td>参数名称: <input type="text" name="names[]" id=""></td>
            <td>参数值: <input type="text" name="can[]" id=""></td>
        </tr>

        <tbody id="xxoo">

        </tbody>
        <tr>
            <td><a href="javascript:;" id="add"> 添加一个参数</a></td>
            <td><input type="submit" value="提交"></td>
        </tr>
    </table>
</form>
    <div>
        返回结果:
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </div>



</body>
</html>
<script src="/admin/jquery.js"></script>
<script>

    // alert(xx);
    $('#add').on('click',function () {
        // alert(22);
       var kk= $('#llll').clone();
        $('#xxoo').append(kk);
    });
    // $('#submit').on('click',function () {
    //     // alert(22);
    //     var method_do='';
    //     var array=[];
    //     var attr=[];
    //     var xx=$("input:radio");
    //     xx.each(function () {
    //         if($(this).prop('checked')==true){
    //            method_do=$(this).val();
    //         }
    //         // $(this).prop('checked')
    //     });
    //     //复选框
    //     // var xx=;
    //     xx.each(function () {
    //         if($(this).prop('checked')==true){
    //             method_do=$(this).val();
    //         }
    //         // $(this).prop('checked')
    //     });
    //
    //
    // })
</script>