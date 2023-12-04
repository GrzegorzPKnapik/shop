<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index(){


            $products = Session::get('sort_p');
            //wypluwa posortowane


            if(Session::get('sort_p') == null)
            {
               $products=Product::all();
               //dd($products);
            } //dd($products);

                //Session::forget('sort_p');

                //echo $products;
                /*dd($products);*/
            return view('shop.index', ['products'=>Session::get('sort_p')]);

    }

    public function sort(Request $request){



        if($request->select == 2)
            $products =  Product::orderBy('price', 'asc')->get();

        if($request->select == 3)
            $products =  Product::orderBy('price', 'desc')->get();

        Session::put('sort_p', $products);

        return redirect()->action([ShopController::class, 'index']);
    }


    public function search(Request $request){

        if($request == 2)
        $products =  Product::orderBy('price', 'asc')->paginate(3);

        if($request == 3)
            $products =  Product::orderBy('price', 'desc')->paginate(3);

        $this->index($products);

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
