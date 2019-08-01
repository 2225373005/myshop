<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加调研问题</title>
	<script src="/admin/jquery.js"></script>
</head>
<body>
        <select name="" id="aa">
           <option value="0">请选择</option>
           <option value="1">单选</option>
           <option value="2">多选</option>
           <option value="3">判断</option>
        </select><br>
        <div>
     <form  class="1" style="display:none;" action="{{url('kao/ccc_do')}}" method="post">  
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
	    <form class="2"  style="display:none;" action="{{url('kao/ccc_do')}}" method="post"> 
	    @csrf
        <div>
                 <input type="hidden" name="d_id" value="2">
	             <tr>
	             	<td>多选题目名</td>
	             	<td><input type="text" name="c_info" id=""></td>
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
	    <form class="3"  style="display:none;" action="{{url('kao/ccc_do')}}" method="post"> 
	    @csrf
        <div>
                 <input type="hidden" name="d_id" value="3">
	             <tr>
	             	<td>判断题目名</td>
	             	<td><input type="text" name="c_info" id=""></td>
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
    	 $('form').hide();
    	$('#aa').change(function(){
    	var aa=$(this).val();
           $("."+aa).show().siblings().hide();
    		// alert(123);
    	})
    })
</script>