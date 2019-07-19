<?php

namespace App\Http\Middleware;

use Closure;

class Update
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
        $time = time();
        $time1=strtotime(date('Y-m-d h:i:s',strtotime('9:0:0')));
        $time2=strtotime(date('Y-m-d h:i:s',strtotime('17:0:0')));
       if($time1>$time&&$time>$time2){
         return redirect('admin/list_goods');
         
       }
         
        
       
        return $next($request);
    }
}
