<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function index()
    {
        $addresses = Address::with('contact')->get();
        return view('account.index', ['addresses'=>$addresses]);
    }

    public function edit(Address $address){
        return view('account.address-edit',['address'=>$address]);
    }


    public function store(StoreAddressRequest $request): RedirectResponse
    {

        $user = Auth::user();

        $contact = new Contact($request->validated());
        $contact->phone_number = $request->phone_number;
        $contact->save();

        $address = new Address($request->validated());
        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;
        $address->CONTACTS_id=$contact->id;
        $address->USERS_id=$user->id;
        $address->save();

        return redirect()->route('account.index')->with('status',__('shop.product.status.store.success'));
    }

    public function update(StoreAddressRequest $request, Address $address): RedirectResponse{
        $contact = Contact::find($address->CONTACTS_id);
        $contact->phone_number = $request->phone_number;
        $contact->save();

        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;




        $address->save();

        return redirect()->route('account.index');
    }


}
