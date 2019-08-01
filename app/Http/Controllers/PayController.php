<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pay;
use DB;
class PayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath = '';  //路径
    public $aliPubKey = '';  //路径
    public $privateKey = 'MIIEowIBAAKCAQEAo9zsXgoxPe4ajDYUjpUCs0xvqhZfj3WsF95LIzjKB9f/NO6ls+vaWj5WgGoeBH47ItyHOA1BzfbjhJ+52zNXGpgcssX0sWnxJ16MbyEVkcqGlZDZWRMUcPQ/0maT8UZxUhqnf6X+WeeuPx5TeVyckc9OjeYt4n9gGAe0XwUFid9pgh7Nqsgv61kv7Y4K7CbO6oQb8hZbM5nOxD+4Xddi9YZ44GhWtmTgh8dM9woqZV1IlweaARapK0XrE9EXZeA3CnwxoTXHexX66Jz/Z5sugCC1B9HnWU7oJi7yyxK9WHUvG4mF5+xuI+3sFwzr5u7y2aFl8rz3HaNC0I0w7yU0ZQIDAQABAoIBAHvmhkstBcLAEQ7HrY+KGHqeZyiCtkrxPOjnSoUdYZXAutW5RU3gHkByNlHu6zeWgvx/Jzc4vvMPpUUYyR13mnsfXUPH7pdfddrA4Qr+RyLvsgfReKajiKdH6CIdMewTyYe9Y71fNA2i4twTACcZ4cFWsR0WWMeUbIJ/AOGAGIoAT92wwD8lF8Kfzw4Z4Y9gQFXLf3ZkZS+fxsP54iEDt7i+inpF4whVQo9yI1fxRYOgO36uM1+9FX9UdELe78Je3Jm4gZO36iGMJweQqtt4GXom1VbwPKv/unp5OvsrbdzoFnKUJHgF7EJgFFltT7B7S095m9aXB+G+kD8l2tlGDNkCgYEA1uHXg4Y/gD91yecS3IYp+ZEFvp6lM9wIheDBNjP2SYGSrmuesJAiGzzBqzvm/r8mDnUiDOip7di9WffZy/1/wf6vXpmULnngNaF9dRN41//JwKdZM0Rawa1qC+z77YVXJCA3kGO4Dk1PbM0R2CVa1snCcK4OTU2GFH1zDon4pwsCgYEAwzfeaH0iuUgk0Chi8ZjyY5pBqBcNHq8A7puEWHf7HKyXhLBxl3IWST3QWuSuCZ7u0EEHcLvjNEoKacncRc+vU/L8ooeLyYmlENFWjpMP+QZjNg9Ap0oXB3lmok0dzSWcDqq3RVTe9PikJSoBJY8+2YTWK0C4d1N0Qq4zQx8l+E8CgYBKygwSkPUlE/FRNoXQDzoozJrtP5ZMOHcW8aUN0oQUDW8aGgb/eQsF492cVZsOa0U5nvcc+xW53Mf6ulMptq9yu8wZ5uY2TuEEiZJ63y4eL77uuNBJEa9s3YidYfxFLTWpMzVjofF7uNi+C5n8WvQE8fAk+8+qhCL4mrkjBE5xBQKBgGc5vZMGyDus2DpxgJA7zb+5K4qUVc2pwBZriXm2R8QLxzrUidwI6Zvk4a2OSjCwJ5tbJ3IHB8b4d7UkliMcBJuhWtEeV15EOFJCP0C4prOJGyDUw90xoifDm++qU13My04+GxbAH/ztFO7J3T1dF2CxiwXn/SKrsEgqENUnPU6lAoGBAIwmcd0JYVL3iYQwSJEqFWIprGH5C7j7Z3LF6ZFloZ8jDbuSOisKKV66JDU2XYpznvIc0Kf/lcvRvBdZWeTM2sugvxpbYbouGaOKzLnZJaaxhuBcD4mObj9zCNGvSlrtfp1LvBfeX2a4rQb8fyjUdvjZx0RvPHg/x0f5Ma9ObFEG';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAo9zsXgoxPe4ajDYUjpUCs0xvqhZfj3WsF95LIzjKB9f/NO6ls+vaWj5WgGoeBH47ItyHOA1BzfbjhJ+52zNXGpgcssX0sWnxJ16MbyEVkcqGlZDZWRMUcPQ/0maT8UZxUhqnf6X+WeeuPx5TeVyckc9OjeYt4n9gGAe0XwUFid9pgh7Nqsgv61kv7Y4K7CbO6oQb8hZbM5nOxD+4Xddi9YZ44GhWtmTgh8dM9woqZV1IlweaARapK0XrE9EXZeA3CnwxoTXHexX66Jz/Z5sugCC1B9HnWU7oJi7yyxK9WHUvG4mF5+xuI+3sFwzr5u7y2aFl8rz3HaNC0I0w7yU0ZQIDAQAB';
    public function __construct()
    {
        $this->app_id = '2016101100657581';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('APP_URL').'/notify_url';
        $this->return_url = env('APP_URL').'/return_url';

    }


    public function do_pay(Request $request){

        $where =$request->session()->get('goods_id');
        $total_amount = DB::table('cart')->whereIn('goods_id',$where)->sum("goods_price");
        //生成订单
        // dd($total_amount);
        // dd($total_amount);
        $oid = time().mt_rand(1000,1111);  //订单编号
        $this->dingdan($request,$total_amount,$oid);


        $order = [
                'out_trade_no' => $oid,
                'total_amount' => $total_amount,
                'subject' => 'test subject - 测试',
            ];

        return Pay::alipay()->web($order);
        // $this->ali_pay($oid);
    }


     //订单页面
    public function dingdan($request,$total_amount,$oid){
    //开启事物
    DB::beginTransaction();
    
         $value = $request->session()->get('name');
         $goods_id = $request->session()->get('goods_id');

         $model = DB::table('order')->insert([
                'oid'=>$oid,
                'uid'=>$value->id,
                'pay_money'=>$total_amount,
                'state'=>'0',
                'add_time'=>time(),
            ]);
        if(!$model){
            DB::rollBack(); 
            echo '操作失败';  die;
        }
       DB::commit(); 
         //异步里删除同步不删除
         // if($model){
         //    $where=[
         //        ['uid'=>$value->id],
         //    ];
         //    DB::table('cart')->where($where)->whereIn('goods_id',$goods_id)->delete();
         // }
    //事物提交中间逻辑代码
   
    
    // }catch (\Exception $e) { 
    // //接收异常处理并回滚 
    // DB::rollBack(); 
    // echo '操作失败';  die;
    // }



    }

   
    
    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
    	if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
    		$priKey=$this->privateKey;
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
    	}else{
    		$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
    	}
        
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }

    

    /**
     * 根据订单号支付
     * [ali_pay description]
     * @param  [type] $oid [description]
     * @return [type]      [description]
     */
    public function ali_pay($oid){
        $order = [];
        $order_info = $order;
        //业务参数
        $bizcont = [
            'subject'           => 'Lening-Order: ' .$oid,
            'out_trade_no'      => $oid,
            'total_amount'      => 10,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;
        // dd($url);
        header("Location:".$url);
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝同步通知回调
     */
    public function aliReturn()
    {
        
        header('Refresh:2;url=/index/dingdan');
        echo "<h2>订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转</h2>';
    }
    /**
     * 支付宝异步通知
     */
    public function aliNotify()
    {
        
        $data = json_encode($_POST);
        $log_str = '>>>> '.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        
        if($res){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
            //验证订单交易状态
            if($_POST['trade_status']=='TRADE_SUCCESS'){


                
            }
        }
        
        echo 'success';
    }
    //验签
    function verify($params) {
        $sign = $params['sign'];
        if($this->checkEmpty($this->aliPubKey)){
            $pubKey= $this->publicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }else {
            //读取公钥文件
            $pubKey = file_get_contents($this->aliPubKey);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }
        
        
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        
        if(!$this->checkEmpty($this->aliPubKey)){
            openssl_free_key($res);
        }
        return $result;
    }
}
