
@extends('index.layouts.common')
@section('title', '显示')
@section('body')


  <!-- end cart menu -->
        
            
    <!-- wishlist -->
    <div class="wishlist section">
        <div class="container">
            <div class="pages-head">
                <h3>订单列表</h3>
            </div>
            <div class="content">
            @foreach($data as $v)
                <div class="cart-1">                  
                    <div class="row">
                        <div class="col s5">
                            <h5>订单编号</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$v->oid}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>订单状态</h5>
                        </div>
                        <div class="col s7">
                            <h5>
                                @if($v->state==1)
                                   已支付
                                @elseif($v->state==3)
                                   已过期
                                @else
                                   未支付
                                @endif
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>订单金额</h5>
                        </div>
                        <div class="col s7">
                            <h5>${{$v->pay_money}}</h5>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col s5">
                            <h5>订单过期时间</h5>
                        </div>
                        <div class="col s7">
                            <h5>300</h5>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col s5">
                            <h5>操作</h5>
                        </div>
                        <div class="col s7">
                            <h5><i class="fa fa-trash"></i></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col 12">
                       </div>
                    </div>
                </div>
            @endforeach
                                
            </div>

        </div>
    </div>
    <!-- end wishlist -->

@endsection


