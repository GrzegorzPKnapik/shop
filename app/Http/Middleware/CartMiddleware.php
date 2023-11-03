<?php

namespace App\Http\Middleware;

use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


        public function handle($request, Closure $next) {



        if(Auth::check()) {


            $user = Auth::user();
            $shopping_list = Shopping_list::where('status', 'shopping_list')->where('USERS_id', $user->id)->first();

            if ($shopping_list) {
                $shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->with('product.image', 'shopping_list')->get();

                View::share(['cart' => $shopping_list, 'items' => $shopping_lists_product]);
            }
        }
        return $next($request);
    }


}
