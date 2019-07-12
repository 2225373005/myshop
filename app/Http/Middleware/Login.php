<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        // 前
      // $aa =$request->session()->has('username');
      // dd($aa);
      if ($request->session()->has('username')=="false") {
           return redirect('user/login'); 
        }  
     
        echo 123;
        $response = $next($request);
        // 后
       echo 5555;

        return $response;
    }
}
