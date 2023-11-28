<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        //$products=Product::with('image')->get();
        //$shopping_list = Shopping_list::where('status', 'lista_a')->first();
        //if($shopping_list != null)
           // $cart = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->with('product.image','shopping_list')->get();


        $products=Product::where('status', '!=', ProductStatus::DISABLE)->get();
        return view('welcome', ['products'=>$products]);
    }
}
