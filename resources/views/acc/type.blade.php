@extends('acc.common')

@section('title', '分类属性')

@section('content')
<div class="container">

    <form role="form" action="{{url('acc/type_add')}}" method="post" >
        <div class="form-group">
            <label>商品类型</label>
            <input type="text" name="tnames" placeholder="请输入您商品类型" class="form-control">
        </div>

        <div>
            <input type="submit" value="添加">


            <label>
                <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>自动登录</label>
        </div>
    </form>
</div>
@endsection