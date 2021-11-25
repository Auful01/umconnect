<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Status
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $statuses = [0, 1];

        foreach ($statuses as $status) {
            $user = Auth::user()->status;
            if ($user == $status) {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
