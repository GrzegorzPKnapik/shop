<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Image;
class ProductController extends Controller
{



    public function create()
    {
        $product=Product::with('image')->get();
        return view('products.create',['product'=>$product]);

    }

    public function store(Request $request){

        $image = new Image();
        if($request->hasFile('image'))
        {
            $image->name=$request->file('image')->store('products');
        }
        $image->save();


        $product = new Product();
        $product->name=$request->name;
        $product->IMAGES_id=$image->id;;

        $product->save();

        return redirect()->route('welcome.index');
    }


}
