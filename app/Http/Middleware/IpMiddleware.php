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

        if(preg_match($pattern, $request->ip()) == 0 && preg_match("/not_allowed_ip$/", $request->url()) == 0){
            return redirect('not_allowed_ip');
        }
        else if(preg_match($pattern, $request->ip()) == 1 && preg_match("/not_allowed_ip$/", $request->url()) == 1){
            return redirect()->route('application.new');
        }
        else {
            return $next($request);
        }
    }
}
