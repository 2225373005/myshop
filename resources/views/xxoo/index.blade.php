<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加我的表白</title>
    <script src="/admin/jquery.js"></script>
</head>
<body>
<form action="{{url('xxoo/add')}}" method="post">
    @csrf
    <table width="500" >

        <h1 align="center">
           请选择分类:<select name="yi" id="" class="aa">
                            <option value="">请选择</option>
                            <option value="1">一级菜单</option>
                            <option value="2">二级菜单</option>
                      </select>
        </h1>
        <div class="bb">
        <div id="1" style="display:none">
            <h1 align="center">一级菜单<input type="text" name="name" id=""></h1>
        </div>
        <div id="2" style="display:none">

            <h1 align="center"></h1>
            <h1 align="center"></h1>
            <h1 align="center"></h1>
            <h1 align="center"></h1>
        </div>
        </div>
        <h1 align="center">
            前选择类别: <select name="type" class="dd" id="">
                                <option value="">请选择</option>
                                <option value="click">点击</option>
                                <option value="view">网页</option>
                        </select>
        </h1>
        <div>
            <div class="click" style="display:none"  align="center">点击 <input type="text" name="click" id=""></div>
            <div class="view" style="display:none"  align="center">网页  <input type="text" name="url" value="https://" id=""></div>
        </div>

        <h1 align="center"><input type="submit" value="添加"></h1>
    </table>
</form>

</body>
</html>
<script>
    $(function () {
       $('.aa').change(function(){
           var aa=$(this).val();
           // alert(aa);
         if(aa==''){
             $('.bb').children().hide();
         }  else{
             $('#'+aa).show().siblings().hide();
         }
       });

      $('.dd').change(function(){
          var aa=$(this).val();
          $('.'+aa).show().siblings().hide();
      })
       // alert(aa);
    })
</script>