<?php

namespace App\Http\Controllers\acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\ShopCategory;
use App\Http\Model\ShopAttribute;
use App\Http\Model\ShopType;
use App\Http\Model\ShopGoods;
use App\Http\Model\ShopGoodsattr;
use App\Http\Model\ShopCargo;
use App\Http\Model\Deng;
use DB;

class MyshopController extends Controller
{
    public $request;
    public $info;
    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->info=[];
    }
    public function login(){

        return view('acc/login');
    }
    public function login_do(){
        $name = $this->request->name;
        $pwd = $this->request->pwd;
        $data = Deng::where('name',$name)->where('pwd',$pwd)->first();
        if($data){
            $this->request->session()->put('shop_name',$name);
            return redirect('acc/index');
        }else{
            return redirect('acc/login');
        }


    }
    //添加分类
    public function index(){
       $data= ShopCategory::select('cnames','cid','ctype')->get()->toArray();
       $data=$this->xxoo($data);

//       dd($data);
       if(empty($data)){

         $data=[];
       }
//       dd(22);
        return view('acc.index',['data'=>$data]);
    }
  //无限极分类
    public function xxoo($data,$pid=0,$path=2){

        foreach ($data as $v){
//            var_dump($data);
            if($v['ctype']==$pid){
                $v['path']=$path*2;
//                dd($v);
//                var_dump($v);
                $this->info[]=$v;

                $this->xxoo($data,$v['cid'],$v['path']);
//                print_r($v);
            }

        }
        return $this->info;
//        dd($info);
    }
   //添加分类
    public  function  category_add(){
        $data=$this->request->all();
        $data = ShopCategory::insert($data);
        if($data){
            return redirect('acc/index');
        }
    }
    //验证分类唯一
    public function yan(){
        $cnames =$this->request->cnames;

        $data=ShopCategory::where('cnames',$cnames)->first();
        if($data){
            return ['code'=>0];
        }else{
            return ['code'=>1];
        }
    }
    //添加商品
    public function shop(){
        $info=ShopCategory::get()->toArray();
        $info=$this->xxoo($info);
//        dd($info);

        $data = ShopType::get()->toArray();
//        dd($data);

        return view('acc/shop',['data'=>$data,'info'=>$info]);
    }
    public function shop_add(){
        $data = $this->request->all();
//        dd($data);

        $info=ShopGoods::insertGetId([
            'g_name'=>$data['g_name'],
            'cat_id'=>$data['cat_id'],
            'g_price'=>$data['g_price'],
            'g_content'=>$data['g_content'],
        ]);
        foreach ($data['a_id'] as $k=>$v ){
            ShopGoodsattr::insert([
                'g_id'=>$info,
                'a_id'=>$v,
                'attr_name'=>$data['attr_name'][$k],
                'attr_price'=>$data['attr_price'][$k],
            ]);
        }
        return redirect('acc/huo/'.$info);
//        dd($data);



    }
//--------------------------------------------------------------------------------------------------
    public function shop_select(){
        $tid=$this->request->select;
       $data =ShopAttribute::where('tid',$tid)->get()->toArray();
//        dd($data);
      return ['code'=>200,'data'=>$data];
//        return view('acc/shop',['data'=>$data]);
    }


    //添加属相
    public function shu(){
        $data = ShopType::get()->toArray();

//        dd($data);
        foreach ($data as $k=>$v){
            $info=ShopType::leftJoin('shop_attribute', 'shop_type.tid', '=', 'shop_attribute.tid')->where('shop_attribute.tid',$v)
                ->count();

            $data[$k]['num']=$info;
//
//            dump($info);
        }
//        dd($data);

//        dd($data);

        return view('acc/shu',['data'=>$data]);

    }
    public function shu_list(){

       $id=$this->request->id;

//       $info=ShopAttribute::where('tid',$id)->get()->toArray();
        $info=ShopAttribute::where('shop_attribute.tid',$id)->join('shop_type', 'shop_attribute.tid', '=', 'shop_type.tid')->get()->toArray();
//       dd($info);
       $data = ShopType::get()->toArray();

//       dd($data);
//        dd($data);

        return view('acc/shu_list',['data'=>$data,'cid'=>$id,'info'=>$info]);
    }
    public function shu_add(){
        $id=$this->request->id;
        $data = ShopType::get()->toArray();
//        dd($data);
        return view('acc/shu_add',['data'=>$data,'cid'=>$id]);
    }
    public function shu_add_do(){
//        dd(222);
       $data = $this->request->all();
       $data = ShopAttribute::insert($data);
       if($data){
          return redirect('acc/shu_add');
       }
//       dd($data);
    }
    public function shu_delete(){
        $data = $this->request->all();
        return ['code'=>200];
//        dd($data);
    }
    public function select(){
        $id = $this->request->select;
        $where=[];
        if($id!=0){
            $where=[
                ['shop_attribute.tid','=',$id]
            ];
        }
//       $info=ShopAttribute::where('tid',$id)->get()->toArray();
        $info=ShopAttribute::where($where)->join('shop_type', 'shop_attribute.tid', '=', 'shop_type.tid')->get()->toArray();
//        dd($info);
        return ['code'=>'200','info'=>$info];


    }
    //添加类型
    public function type(){

//        dd(22);
        return view('acc/type');

    }
    //添加类型
    public function type_add(){
        $data = $this->request->all();

        $data = ShopType::insert($data);
        if($data){
            return view('acc/type');
        }
    }

    //货品页
    public function huo($id){
//        dd($id);
          $data = ShopGoods::where('g_id',$id)->first()->toArray();
//          dd($data);
        $info=ShopGoodsattr::leftJoin('shop_attribute', 'shop_goodsattr.a_id', '=', 'shop_attribute.aid')->where('shop_goodsattr.g_id',$id)->where('shop_attribute.atype','2')
            ->get()->toArray();
//        dd($info);
        $xxoo=[];
        foreach ($info as $k=>$v){

            $xxoo[$v['anames']][]=$v['attr_name'];
        }
//        dd($xxoo);
        return view('acc/huo',['data'=>$data,'xxoo'=>$xxoo,'id'=>$id]);

    }
    public function huo_add(){
        $id=$this->request->id;
        $data = $this->request->all(); //查询所有数据
//        dd($data);
        $num = count($data['select']) / count($data['product_number']);
        $info = array_chunk($data['select'],$num);
//        dd($info);
//        dd($data);
        $mmm=[];
        foreach ($data['product_number'] as $k=>$v){
//            dump($k);
//            dump($data['product_sn'][$k]);
            $mmm[]=[
                'g_id'=>$id,
                'attr_id'=>implode(',',$info[$k]),
                'goods_num'=>$data['product_sn'][$k],
                'number'=>$v,
            ];

//            $data=ShopCargo::insert([
//                'g_id'=>$id,
//                'attr_id'=>implode(',',$info[$k]),
//                'goods_num'=>$data['product_sn'][$k],
//                'number'=>$v,
//            ]);
        }
        $data=ShopCargo::insert($mmm);
        if($data){
            return redirect('acc/huo_list');
        }
//        dd($data);
//        dd($mmm);
    }
    public  function huo_list(){
//        $xxoo['g_name']='';
        if($this->request){
            $xxoo=$this->request->all();
        }
        $cid= $this->request->cid;
        $c_show= $this->request->c_show;
        $g_name= $this->request->g_name;
//dump($g_name);
//        var_dump($xxoo);
        $where=[];
        if(isset($cid)){
            $where[]=
              ['cid','=',$xxoo['cid']]
            ;
        }
        if(isset($c_show)){
            $where[]=
                ['cshow','=',$xxoo['c_show']]
            ;
        }
        if(!empty($g_name)){
            $where[]=
                ['g_name','like','%'.$xxoo['g_name'].'%']
            ;
        }
//        var_dump($where);
        $info=ShopCategory::get()->toArray();
        $info=$this->xxoo($info);
//        dd($xxoo);

        $data = ShopGoods::where($where)->leftJoin('shop_category', 'shop_goods.cat_id', '=', 'shop_category.cid')
            ->paginate(1);
//        dd($data);
        return view('acc/huo_list',['info'=>$data,'xxoo'=>$info,'g_name'=>$g_name,'cid'=>$cid,'c_show'=>$c_show]);
    }
    public function huo_dian(){
        $data = $this->request->all();
        $data = ShopGoods::where('g_id',$data['g_id'])->update([
            'g_name'=>$data['name'],
            'g_id'=>$data['g_id'],
        ]);
        if($data){
            return ['code'=>200];
        }
//        dd($data);
    }

}
