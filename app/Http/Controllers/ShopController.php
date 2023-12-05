<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index(Request $request){


        $selected = $request->select;
        //Session::forget('sort_select');
            if ($selected == null) {
                $selected =  Session::get('sort_select');
                $products = Product::paginate(2);
            }

            if ($selected == 1) {
                $products = Product::paginate(8);
                Session::put('sort_select', 1);
            }
            if ($selected == 3) {
                $products = Product::orderBy('price', 'asc')->paginate(2);
                Session::put('sort_select', 3);
            }
            if ($selected == 4) {
                $products = Product::orderBy('price', 'desc')->paginate(2);
                Session::put('sort_select', 4);
            }







        return view('shop.index', ['products'=>$products, 'sort_select'=> Session::get('sort_select')])->render();

    }
    //przesłac ajaxowow wartosc sort
    /*public function pagination(Request $request){
        $s=Session::get('sort_select');

        $products=Product::paginate(3);
        return view('shop.pagination', ['products'=>$products, 'sort_select'=>$s])->render();
    }*/


    public function sort(Request $request){


        $selected = $request->select;
        if ($selected == 1) {
            $products = Product::paginate(8);
            Session::put('sort_select', 1);
        }
        if ($selected == 3) {
            $products = Product::orderBy('price', 'asc')->paginate(2);
            Session::put('sort_select', 3);
        }
        if ($selected == 4) {
            $products = Product::orderBy('price', 'desc')->paginate(2);
            Session::put('sort_select', 4);
        }



        //Session::put('sort_select', $request->select);


        return redirect()->action([ShopController::class, 'index']);
    }


    public function search(Request $request){


        //return view('shop.index', ['products'=>$products]);
        //$this->index($products);
       /* $search = $request->input('search');


        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->paginate(3);


        return view('shop.index', ['products'=>$products]);*/

       /* $products = Product::paginate(3);

        if ($request->ajax()) {
            return response()->json([
                'products' => view('products.pagination', compact('products'))->render(),
            ]);
        }*/

        //$products = $products->previousPageUrl();

        /*$search = $request->input('search');


        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->paginate(3);


        return view('shop.index', ['products'=>$products]);*/

    }


}
