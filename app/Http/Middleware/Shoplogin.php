<?php

namespace App\Http\Middleware;

use Closure;

class Shoplogin
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
        $name=$request->session()->has('shop_name');
        if(empty($name)){
            return redirect('acc/login');
        }

        return $next($request);
    }
}
