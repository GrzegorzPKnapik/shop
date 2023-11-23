<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Description;
use App\Models\Order;
use App\Models\Producer;
use App\Models\Status;
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

class StatusController extends Controller
{
    public function index()
    {
        $statuses=Status::all();
        return view('statuses.index',['statuses'=>$statuses]);
    }


    public function create()
    {
        return view('statuses.create');
    }

    public function store(StoreProducerRequest $request): RedirectResponse{
        $status = new Status();
        $status->name = $request['name'];
        $status->status = 'enable';
        $status->save();

        return redirect()->route('status.index')->with('status',__('shop.product.status.store.success'));
    }



    public function destroy(Status $status): JsonResponse{
        try {

            //$producer->delete();
            $status->status = 'disable';
            $status->save();


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

    public function edit(Status $status){
        return view('statuses.edit',['status'=>$status]);
    }

    public function update(StoreProducerRequest $request, Status $status): RedirectResponse{

        $status->name=$request['name'];
        $status->save();
        return redirect()->route('status.index');
    }


}
