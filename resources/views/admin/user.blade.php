@extends('admin.layouts.common')

@section('title', '主题')

@section('body')
<table border="2">

   <tr>
   	<td>ID</td>
   	<td>用户名</td>
   	<td>操作</td>
    <td>禁用用户</td>

   </tr>
    @foreach ($info as $user)
   <tr>
    <td>{{ $user->id }}</td>
   	<td>{{ $user->name }}</td>
   	<td>
      @if($user->root==1)
          <button>已授权</button>
          <button>禁用用户</button>
      @else
         <button class="aa" root="{{$user->id}}">授权</button>
         
      @endif
    </td>

   </tr>
@endforeach

</table>


<script>
// $(function(){
// 
   $('.aa').click(function(){
      alert(132);
      var _this=$(this);
      var val=$(this).attr('root');
           $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          
      });
 $.post( 
                 "{{url('admin/shouquan')}}",
                 { id:val },
                function( data ) {
                   if(data.code==1){
                      _this.html('已授权')
                   }
                },
                'json',
              );
   })
// })
   
       
  
  
</script>
@endsection