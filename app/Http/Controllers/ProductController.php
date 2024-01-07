<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatus;
use App\Enums\ProducerStatus;
use App\Enums\ProductStatus;
use App\Enums\ShoppingListActive;
use App\Enums\ShoppingListStatus;
use App\Events\UnavailableProductInSL;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Description;
use App\Models\Producer;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;

use App\Models\Image;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use JsValidator;

class ProductController extends controller
{
    public function index()
    {
        $products=Product::with('image', 'category')->paginate(10);



        return view('products.index',['products'=>$products]);
    }


    public function show(Product $product){
        return view('products.show',['product'=>$product]);

    }

    public function create()
    {
        $producers=Producer::where('status', '!=', ProducerStatus::DISABLE)->get();
        $categories=Category::where('status', '!=', CategoryStatus::DISABLE)->get();
        //chyba nie trzeba product przesyłać
        //$product=Product::with('image')->get();
        return view('products.create',['categories'=>$categories, 'producers'=>$producers]);

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
        $product->status = ProductStatus::ENABLE;

        $product->price = $request['product_price'];
        if (strpos($request['product_price'], '.') === false) {
            $product->price = $request['product_price'].= '.99';
        }/*else $product->price = number_format($request['product_price'], 2, '.', '');*/

        //$product->CATEGORIES_id = $request['category_select'];
        //$product->PRODUCERS_id = $request['producer_select'];
        $product->category()->associate($request['category_select']);
        $product->producer()->associate($request['producer_select']);

        $description = new Description();
        $description->name = $request['description_name'] ?? '';
        $description->ingredients = $request['description_ingredients'] ?? '';
        $description->calories = $request['description_calories'] ?? '';
        $description->save();

        $product->image()->associate($image);
        $product->description()->associate($description);
        $product->save();


        return redirect()->route('product.index')->with('status',__('shop.product.status.store.success'));
    }



    public function destroy(Product $product): JsonResponse{
        //$image = Image::find($product->IMAGES_id);
        //$oldPath = $image->name;

        try {
            $product->status = 'disable';
            $product->save();
            event(new UnavailableProductInSL());

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
        $producers=Producer::where('status', '!=', ProducerStatus::DISABLE)->get();
        $categories=Category::where('status', '!=', CategoryStatus::DISABLE)->get();

        return view('products.edit',['product'=>$product, 'categories'=>$categories, 'producers'=>$producers]);
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse{

        $old_product_status = $product->status->value;
        //dd($request['description_name']);
        $image = Image::find($product->IMAGES_id);
        $oldPath = $image->name;
        //$product->fill($request->validated());
        $product->price=$request['product_price'];
        $product->name=$request['product_name'];
        $product->status=$request['product_status'];




        if ($request->hasFile('image_name') && $request->validated()) {
            //delete images from products
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
            $image->name = $request->file('image_name')->store('products');
            //save only for changed image
            $image->save();
        }

        //$product->CATEGORIES_id = $request['category_select'];
        //$product->PRODUCERS_id = $request['producer_select'];
        $product->category()->associate($request['category_select']);
        $product->producer()->associate($request['producer_select']);


        //Trzeba użyć metody update, aby zaktualizować dane w relacji
        $product->description->update([
            'name' => $request['description_name'] ?? '',
            'ingredients' => $request['description_ingredients'] ?? '',
            'calories' => $request['description_calories'] ?? '',

        ]);

        $product->save();



        if ($old_product_status != $request['product_status'] && $request['product_status'] != ProductStatus::ENABLE->value)
        {
            //oblicz koszyk na nowo
            $shopping_lists = Shopping_list::where('status', ShoppingListStatus::NONE)
                ->orWhere('status', ShoppingListStatus::CART)
                ->whereHas('shopping_lists_products.product', function ($query) {
                    $query->where('status', '!=', ProductStatus::ENABLE);
                })
                ->get();

            //działa
            foreach ($shopping_lists as $shopping_list) {
                $total = Shopping_lists_product::whereHas('shopping_list', function ($query) use ($shopping_list) {
                    $query->where('id', $shopping_list->id);
                })
                    //warunek, że status produktu musi być równy ProductStatus::ENABLE,
                    ->whereHas('product', function ($query) {
                        $query->where('status', ProductStatus::ENABLE);
                    })
                    ->where('selected', true)
                    ->sum('sub_total');

                $shopping_list->total = $total;
                $shopping_list->save();
            }

            event(new UnavailableProductInSL());
        }


        return redirect()->route('product.index');
    }



}
