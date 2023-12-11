<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Description;
use App\Models\Order;
use App\Models\Producer;
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

class ProducerController extends Controller
{
    public function index()
    {
        $producers=Producer::all();
        return view('producers.index',['producers'=>$producers]);
    }


    public function create()
    {
        return view('producers.create');
    }

    public function store(StoreProducerRequest $request): RedirectResponse{
        $producer = new Producer();
        $producer->name = $request['name'];
        $producer->status = 'enable';
        $producer->save();

        return redirect()->route('employeePanel.index')->with('status',__('shop.product.status.store.success'));
    }



    public function destroy(Producer $producer): JsonResponse{
        try {

            //$producer->delete();
            $producer->status = 'disable';
            $producer->save();

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

    public function edit(Producer $producer){
        return view('producers.edit',['producer'=>$producer]);
    }

    public function update(StoreProducerRequest $request, Producer $producer): RedirectResponse{

        $producer->name=$request['name'];
        $producer->save();
        return redirect()->route('employeePanel.index');
    }


}
