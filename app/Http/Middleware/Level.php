<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guards)
    {
        // if (Auth::user()->level == $guards) {
        //     return redirect('logout');
        // }

        // return $next($request);
        $levels = [0, 1];

        foreach ($levels as $level) {
            $user = Auth::user()->level;
            $status = Auth::user()->status;
            if ($user == $level) {
                if ($status == $level) {
                    return $next($request);
                }
            }
        }

        return redirect('/');
    }
}
