<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index()
    {
        $addresses = Address::with('user')->get();
        return view('account.index', ['addresses'=>$addresses]);
    }

    public function edit(Address $address){
        return view('account.address-edit',['address'=>$address]);
    }


    public function store(StoreAddressRequest $request): RedirectResponse
    {
        $address = new Address($request->validated());
        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;

        $address->save();




        return redirect()->route('account.index')->with('status',__('shop.product.status.store.success'));
    }

    public function update(StoreAddressRequest $request, Address $address): RedirectResponse{

        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;



        $address->save();

        return redirect()->route('account.index');
    }


}
