<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // CHECK USER HAVE API_TOKEN AND USER_ID FOR AUTHORIZITION
        if(!request()->query('api_token') && !request()->cookie('token') && !request()->cookie('user_id')) {
            return redirect('login');
        }
        
        // CHECK USER SEND REQUEST FOR EXIT ON DASHBOARD
        if(request()->query('exit')) {
            cookie()->queue(cookie()->forget('token'));
            cookie()->queue(cookie()->forget('user_id'));
            return redirect('login');
        }

        // CHECK IF DONT SET COOKIE, SET COOKIE FOR USER
        if(!request()->cookie('token')) {
            cookie()->queue('user_id', request()->query('id'), 60);
            cookie()->queue('token', request()->query('api_token'), 60);
        }
        return $next($request);
    }
}
