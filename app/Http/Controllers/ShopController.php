<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatus;
use App\Models\Category;
use App\Models\Description;
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

        $query = Product::query()->where('status', '!=', 'disable');



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


        $products = $query->paginate(3)->withQueryString();

        return view('shop.index', ['products'=>$products, 'categories'=>Category::where('status', '!=', CategoryStatus::DISABLE), 'descriptions'=>Description::all()])->render();

    }


    public function product(Product $product)
    {


        return view('shop.product', ['product'=>$product])->render();

    }



}
