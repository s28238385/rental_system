<?php

namespace App\Http\Middleware;

use Closure;

class SearchingCheck
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
        //drop
        /*
        if ( !$request->input() ) {
            return redirect('searching');
        }
        */
        
        return $next($request);
    }
}
