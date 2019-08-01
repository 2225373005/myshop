<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加题库</title>
	<script src="/admin/jquery.js"></script>
</head>
<body>

        <table>
             <tr>
             	<td> <h3>选择题库</h3> </td>
             	<td>
            		<select name="" id="bb">
                        <option value="0">请选择</option>
                        <option value="1">单选</option>
                        <option value="2">多选</option>
                        <option value="3">判断</option>
            		</select>
            		<span class="aa" style="color:red"></span>
             	</td>
             </tr>
        </table>
  <div>
	<form  class="1" style="display:none;" action="{{url('kao/add_do')}}" method="post">  
	@csrf
	    <div class="0">

	    </div>   
	    <div >
	             <input type="hidden" name="d_id" value="1">
	             <tr>
	             	<td>单选题目名</td>
	             	<td><input type="text" name="c_info" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="radio" name="c_answ" value="1" id="">A:</td>
	             	<td><input type="text" name="c_op1" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="radio" name="c_answ" value="2" id="">B:</td>
	             	<td><input type="text" name="c_op2" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="radio" name="c_answ" value="3" id="">C:</td>
	             	<td><input type="text" name="c_op3" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="radio" name="c_answ" value="4" id="">D:</td>
	             	<td><input type="text" name="c_op4" id=""></td>
	             </tr> <br>
	              <input type="submit" value="提交">

        </div>
        </form>   
	    <form class="2"  style="display:none;" action="{{url('kao/add_do')}}" method="post"> 
	    @csrf
        <div>
                 <input type="hidden" name="d_id" value="2">
	             <tr>
	             	<td>多选题目名</td>
	             	<td><input type="text" name="b_info" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="checkbox" name="b_answ[]" value="1" id="">A:</td>
	             	<td><input type="text" name="b_op1" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="checkbox" name="b_answ[]" value="2" id="">B:</td>
	             	<td><input type="text" name="b_op2" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="checkbox" name="b_answ[]" value="3" id="">C:</td>
	             	<td><input type="text" name="b_op3" id=""></td>
	             </tr><br>
	             <tr>
	             	<td><input type="checkbox" name="b_answ[]	" value="4" id="">D:</td>
	             	<td><input type="text" name="b_op4" id=""></td>
	             </tr><br>

	               <input type="submit" value="提交">
        </div>
        </form>   
	    <form class="3"  style="display:none;" action="{{url('kao/add_do')}}" method="post"> 
	    @csrf
        <div>
                 <input type="hidden" name="d_id" value="3">
	             <tr>
	             	<td>判断题目名</td>
	             	<td><input type="text" name="a_info" id=""></td>
	             </tr><br>
	              <tr>
	             	<td>对:<input type="radio" name="a_answ" value="1" id=""></td>
	             	<td>错:<input type="radio" name="a_answ" value="2" id=""></td>
	             </tr><br>
	             <input type="submit" value="提交">
        </div>
    
      </form> 
      </div>
</body>
</html>
<script>
   $(function(){
   	    // $('div').hide();
        $('#bb').change(function(){
        	 var _this = $(this).val();
        	 if(_this==0){
        	 	$(".aa").html("请选择类型");
        	 }else{
        	 	$(".aa").html("");
        	 	$('.'+_this).show().siblings().hide();
        	 }

          

        })

   })
</script>