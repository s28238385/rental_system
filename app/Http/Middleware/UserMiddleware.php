<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        //若身分不是系統管理員則重導至首頁
        if(Auth::user()->role != '系統管理員') {
            return redirect('/');
        }

        //繼續執行下一個程序
        return $next($request);
    }
}
