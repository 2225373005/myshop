<?php

namespace App\Http\Middleware;

use Closure;

class Koo
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
          $name = $request->session()->get('name');
          if(!$name){
            return redirect('koo/log');
          }
    
          $response = $next($request);

    
        return $response;
    }
}
