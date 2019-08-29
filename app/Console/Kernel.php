<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\tool\Wx;
use DB;

class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //定义任务

        $schedule->call(function () {
            $app = app('wechat.official_account');
//            $data=$app->user->list($nextOpenId = null);
//            $data=$data['data']['openid'];
//            $openid = implode(',',$data);

//            $users = $app->user->select([$openid]);
            $data =DB::table('class')->where('openid','ofvtlt41O6T7AjMyUiS-B0ZbJLcI')->first();
            $user =DB::table('openid')->where('openid','ofvtlt41O6T7AjMyUiS-B0ZbJLcI')->first();
//            foreach ($users as $v){
                $app->template_message->send([
                    'touser' => 'ofvtlt41O6T7AjMyUiS-B0ZbJLcI',
                    'template_id' => 'yqub99MNVhC3jt67TWxCM123GMQpqAnIRDhLiZ8kpto',

                    'data' => [
                        'first' =>$user->nickname,
                        'remark' => '第一节'.$data->class1."\n".'第2节'.$data->class2."\n".'第3节'.$data->class3."\n".'第4节'.$data->class4,

        ],
    ]);
//            }

            /*
            $redis = new \Redis();
            $redis->connect('127.0.0.1','6379');
            $url='http://www.wantwo.cn/tool/index';
            \Log::info('222');
//        dd($url);
            $data=file_get_contents($url);

//         dd($data);
            $data = json_decode($data,1)['result'];
//        dd($data);
            foreach ($data as $v){
//             dump($v);
                if($redis->exists($v['city'].'油价')){
                    $info = $redis->get($v['city'].'油价');
                    $info = json_decode($info,1);
//                   dump($info);
//                    dump($v);
                    $ppp=0;
                    foreach ($v as $k=>$vv){
                        if($vv != $info[$k]){
                                                      $ppp=1;

                        }
                    }
//                dd($ppp);
                    if($ppp==1){
                        $xxoo = $app->user->list($nextOpenId = null);
//                    dd($xxoo);
                        $xxoo = $xxoo['data']['openid'];
//                    dd($xxoo);
//dump($v);
                        foreach ($xxoo as $vo){
//   dd($vo);
//                            $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$wx->access_token().'';

                            $app->template_message->send([
                                "touser"=>$vo,
                                "template_id"=>"s-jfOJfqLa2kX7nXsS7trHmo2akdFlMESWBoFMXoRSk",
                                "data"=>[
                                    "aaa"=>[
                                        "value"=>$v['city'].'最新油价'."\n",
                                        "color"=>"#173177"
                                    ],
                                    "bbb"=>[
                                        "value"=>'92:'.$v['92h'].'元'."\n".'95h:'.$v['95h']."\n".'98h:'.$v['98h']."\n".'0h:'.$v['0h']."\n",
                                        "color"=>"#173177"
                                    ],
                                    "fff"=>[
                                        "value"=>date('Y-m-d',time())."\n",
                                        "color"=>"#173177"
                                    ]
                                ]

                            ]);
//                              dd($data);
//                            $data = $wx->post($url,json_encode($oooo,JSON_UNESCAPED_UNICODE));
//                              dd($data);
//                            dump($data);

                        }
                    }


                }
            }

            */
        })->everyMinute();

        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
