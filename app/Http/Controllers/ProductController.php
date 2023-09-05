<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Image;
class ProductController extends Controller
{
    public function index()
    {
        $products=Product::with('image')->get();
        return view('products.index',['products'=>$products]);
    }


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

    public function update(Request $request){

        return redirect()->route('products.update');
    }

    public function destroy($id){

        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }


}
