<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<script src="/admin/jquery.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<form action="{{url('deng/zhu_doo')}}" method="post">
	@csrf
	用户名:<input type="text" name="name"><br>
  	密码 : <input type="password" name="pwd" id=""><br>
  	验证码: <input type="text" name="rand" id=""> <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()"><br> <button type="button"  id="aa"> 获取验证码</button><br>
	
  	<br>
  	<input type="submit" value="注册">		

	</form>
</body>
</html>
<script>
  $(function(){
  	   $('#aa').click(function(){
	  	   	$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }

		});

	  $.post( 
	  	"{{url('deng/zhu_do')}}", 
	  	     
		    function( data ) {
		         alert(data);
		    },
		    'json',
		  );


          	 
  	   })
  })
</script>