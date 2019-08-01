<?php

namespace App\Http\Middleware;

use Closure;

class Ting
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
        $name =$value = $request->session()->get('name');

        if(!$name){
            return redirect('ting/log');
        }
        if($name->root!=1){
            return redirect('ting/ppp');
            // $this->ppp();
        }

        $response = $next($request);

        // Perform action

        return $response;
    }
}
