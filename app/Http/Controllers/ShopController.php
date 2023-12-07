<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index(Request $request){


        $filters = $request->query('filter');
        $sort = $request->sort;
        $search = $request->search;

        $query = Product::query();


        if(!is_null($filters))
        {
            if(array_key_exists('categories', $filters))
                $query->whereIn('CATEGORIES_id', $filters['categories']);
            if(!is_null($filters['price_min']))
                $query->where('price', '>=', $filters['price_min']);
            if(!is_null($filters['price_max']))
                $query->where('price', '<=', $filters['price_max']);

        }
        if(!is_null($sort))
        {
            if($sort == 1);
            else if ($sort== 3)
                $query->orderBy('price', 'asc');
            elseif ($sort == 4)
                $query->orderBy('price', 'desc');
        }

        if(!is_null($search))
        {
            $query->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%");
            });
        }


        $products = $query->paginate(1)->withQueryString();

        return view('shop.index', ['products'=>$products, 'categories'=>Category::all(),'sort_select'=> Session::get('sort_select')])->render();




    }



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
