<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
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

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        return view('categories.index',['categories'=>$categories]);
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse{
        $category = new Category();
        $category->name = $request['name'];
        $category->status = 'enable';
        $category->save();

        return redirect()->route('employeePanel.index')->with('status',__('shop.product.status.store.success'));
    }



    public function destroy(Category $category): JsonResponse{

        try {

            //$category->delete();
            $category->status = 'disable';
            $category->save();

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

    public function edit(Category $category){
        return view('categories.edit',['category'=>$category]);
    }

    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse{

        $category->name=$request['name'];
        $category->save();
        return redirect()->route('employeePanel.index');
    }


}
