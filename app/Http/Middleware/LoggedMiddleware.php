<?php

namespace App\Http\Middleware;

use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class LoggedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle($request, Closure $next) {


        if(!Auth::check()) {
            abort(403, 'Forbidden access for unauthorized');
        }

        return $next($request);
    }

}
