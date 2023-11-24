<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Description;
use App\Models\Order;
use App\Models\Producer;
use App\Models\role;
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

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return view('roles.index',['roles'=>$roles]);
    }


    public function create()
    {
        return view('roles.create');
    }

    public function store(StoreProducerRequest $request): RedirectResponse{
        $role = new Role();
        $role->name = $request['name'];
        $role->save();

        return redirect()->route('role.index')->with('role',__('shop.product.role.store.success'));
    }



    public function destroy(Role $role): JsonResponse{
        try {

            $role->delete();


            return response()->json([
                'role' => 'success',
                'message' => __('shop.product.role.delete.success'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'role' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }

    }

    public function edit(Role $role){
        return view('roles.edit',['role'=>$role]);
    }

    public function update(StoreProducerRequest $request, Role $role): RedirectResponse{

        $role->name=$request['name'];
        $role->save();
        return redirect()->route('role.index');
    }


}
