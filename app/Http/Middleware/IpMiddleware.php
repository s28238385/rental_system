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
        $pattern = "/^140.115.\d{1~3}.\d{1~3}$/";

        if(preg_match($pattern, $request->ip()) == 0 && preg_match("/not_allowed_ip$/", $request->url()) == 0){
            return redirect('not_allowed_ip');
        }

        return $next($request);
    }
}
