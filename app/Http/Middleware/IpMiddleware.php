<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
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
        $pattern = "/^140\.115/";
        $environment = 1;   // 1 for online, 0 for testing

        if(preg_match($pattern, $request->ip()) == $environment){
            if(preg_match("/not_allowed_ip$/", $request->url()) == 0){
                return $next($request);
            }
            else {
                return redirecct('/');
            }
        }
        else {
            return redirect('not_allowed_ip');
        }
    }
}