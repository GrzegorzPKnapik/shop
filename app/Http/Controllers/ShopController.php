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




        /*$filters = $request->query('filter');

        $query = Product::query();

        if(!is_null($filters))
        {
            if(array_key_exists('categories', $filters))
            $query->whereIn('CATEGORIES_id', $filters['categories']);
            if(!is_null($filters['price_min']))
            $query->where('price', '>=', $filters['price_min']);
            if(!is_null($filters['price_max']))
            $query->where('price', '<=', $filters['price_max']);


            return response()->json([
                'data' => $query->get(),

            ]);

        }

        return view('shop.index', [
            'products'=>$query->paginate(3),
            'categories'=>Category::all(),
            'sort_select'=> 2
        ])->render();*/


//dd($request->search);

        $filters = $request->query('filter');
        $sort = $request->query('sort');

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
            if($sort['select'] == 1);
            else if ($sort['select'] == 3)
                $query->orderBy('price', 'asc');
            elseif ($sort['select'] == 4)
                $query->orderBy('price', 'desc');
        }


        $products = $query->paginate(1)->withQueryString();

        return view('shop.index', ['products'=>$products, 'categories'=>Category::all(),'sort_select'=> Session::get('sort_select')])->render();




        //dd(Session::get('search'));
        /*if(!is_null($request->search) || !is_null(Session::get('search')))
        {
            //dd(Session::get('search'));
            //dd($request->search);
            if (!is_null($request->search))
                Session::put('search', $request->search);

            $search = Session::get('search');
            $products = Product::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%");
            })->paginate(1);

            return view('shop.index', ['products'=>$products, 'sort_select'=> Session::get('sort_select'), 'categories'=>Category::all()])->render();

        }*/


        /*$selected = $request->select;
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
        }*/














        //return view('shop.index', ['products'=>$products, 'categories'=>$categories,'sort_select'=> Session::get('sort_select')])->render();

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
