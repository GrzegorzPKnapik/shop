<?php

namespace App\Providers;

use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();
        if($shopping_list != null)
            $cart = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->with('product.image','shopping_list')->get();


        View::share('cart', $cart);
    }
}
