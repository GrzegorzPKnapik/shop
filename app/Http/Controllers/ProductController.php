<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Description;
use App\Models\Order;
use Exception;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use JsValidator;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::with('image', 'category')->get();
        return view('products.index',['products'=>$products]);
    }


    public function create()
    {
        $categories=Category::all();
        $product=Product::with('image')->get();
        return view('products.create',['product'=>$product, 'categories'=>$categories]);

    }

    public function store(StoreProductRequest $request): RedirectResponse{
        $image = new Image();
        if($request->hasFile('image_name'))
        {
            $image->name = $request->file('image_name')->store('products');
        }
        $image->save();

        $product = new Product();
        $product->name = $request['product_name'];
        $product->price = $request['product_price'];

        $product->CATEGORIES_id = $request['category_select'];

        $description = new Description();
        $description->name = $request['description_name'];
        $description->save();

        $product->image()->associate($image);
        $product->description()->associate($description);
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
            //$image->delete();
            $product->delete();

            //jednorazowe wyświetlenie wiadomości
            //Session::flash('status', __('shop.product.status.delete.success'));
            return response()->json([
                'status' => 'success',
                'message' => __('shop.product.status.delete.success'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }

    }

    public function edit(Product $product){
        $categories=Category::all();
        return view('products.edit',['product'=>$product, 'categories'=>$categories]);
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse{


        $image = Image::find($product->IMAGES_id);
        $oldPath = $image->name;
        //$product->fill($request->validated());
        $product->price=$request['product_price'];
        $product->name=$request['product_name'];


        if ($request->hasFile('image_name') && $request->validated()) {
            //delete images from products
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
            $image->name = $request->file('image_name')->store('products');
            //save only for changed image
            $image->save();
        }

        $product->CATEGORIES_id = $request['category_select'];

        $product->save();
        return redirect()->route('product.index');
    }


}
