<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use Exception;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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

    public function store(StoreProductRequest $request): RedirectResponse{

        $image = new Image($request->validated());
        if($request->hasFile('image'))
        {
            $image->name=$request->file('image')->store('products');
        }
        $image->save();


        $product = new Product($request->validated());
        $product->name=$request->name;
        $product->IMAGES_id=$image->id;;

        $product->save();

        return redirect()->route('product.index');
    }

    public function update(Request $request){

        return redirect()->route('products.update');
    }

    public function destroy(Product $product): JsonResponse{

        try {
           // $product = Product::find($id);
            $product->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }

    }


}
