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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('product.index')->with('status',__('shop.product.status.store.success'));
    }



    public function destroy(Product $product): JsonResponse{
        $image = Image::find($product->IMAGES_id);
        $oldPath = $image->name;
        try {
           // $product = Product::find($id);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
            $product->delete();
            Session::flash('status', __('shop.product.status.delete.success'));
            return response()->json([
                'status' => 'success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }

    }

    public function edit(Product $product){
        //Product::with('image')->get();
        return view('products.edit',['product'=>$product]);
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse{

        $image = Image::find($product->IMAGES_id);
        $oldPath = $image->name;
        $product->fill($request->validated());


            if ($request->hasFile('image') && $request->validated()) {
                //delete images from products
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
                $image->name = $request->file('image')->store('products');
                //save only for changed image
                $image->save();
            }




        $product->save();

        return redirect()->route('product.index');
    }


}
