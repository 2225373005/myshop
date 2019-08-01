<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加竞猜</title>
	<script src="/admin/jquery.js"></script>
</head>
<body>
	 <form action="{{url('cai/add_do')}}" method="post" id="datafrom">
	 @csrf
	
         添加竞猜球队
         <input type="text" name="q_name" id="aa">&nbsp;&nbsp;VS&nbsp;&nbsp;<input type="text" name="q_name1" id="bb"><br>
         竞猜结束时间<input type="text" name="odd_time" id=""><br>
         
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
         <input type="submit" value="添加">

	 </form>
</body>
</html>
<script>
   $(function(){
   	 

   	  
   	  	// alert(aa)
   	  	$('#datafrom').submit(function(){
   	  		 var aa =$("#aa").val();
   	         var bb =$("#bb").val();
              	if(aa==bb){
		          alert('两者相同不可添加');
		          return false;
		   	  	} 
   	  	})
   	
   	 
   	  
   })
  
</script>