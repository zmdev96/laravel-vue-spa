<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (request()->method() == 'GET') {
            $current_url = trim($_SERVER['REQUEST_URI'], '/');
            if ($current_url == 'app-admin/login') {
                if (Auth::guard('admin')->check()) {
                    return redirect('/app-admin');
                }
            } else {
                if (Auth::guard('web')->check()) {
                    return redirect('/');
                }
            }
        } else {
            $prev_url = explode($_SERVER['HTTP_HOST'], \Session::get('_previous.url'));
            if (end($prev_url) == '/app-admin/login') {
                if (Auth::guard('admin')->check()) {
                    return redirect('/app-admin');
                }
            } else {
                if (Auth::guard('web')->check()) {
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
