<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Model\Deng;
class Atoken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token=$request->token;
//        dd($token);
//        echo $token;die;
        if(empty($token)){
            echo json_encode(['code'=>'203','msg'=>'请先登录']);die;
        }
        $data = Deng::where('token',$token)->first();

        if($data){
            $time=time();
//            dd($time);
//            echo time();die;
            if($time>$data['extime']){
                //时间过期
                echo json_encode(['code'=>'205','msg'=>'token过期']);die;
            }else{
                //实时更新
                Deng::where('token',$token)->update([
                    'extime'=>time()+7200,
                ]);
                //向控制器传参
                $request->attributes->add(['deng_id'=>$data['id']]);
            }

        }else{

            echo json_encode(['code'=>'204','msg'=>'请先登录']);die;
        }

        return $next($request);
    }
}
