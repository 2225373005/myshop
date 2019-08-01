<?php

namespace App\Http\Middleware;

use Closure;

class Kao
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
        if(!$request->session()->get('name')){
            return redirect('kao/logs');
        }

        $response = $next($request);
        // 后
       // echo 5555;

        return $response;
      
    }
}
