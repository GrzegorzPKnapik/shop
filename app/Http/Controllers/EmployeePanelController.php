<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatus;
use App\Enums\ProducerStatus;
use App\Models\Address;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Producer;
use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EmployeePanelController extends Controller
{

    public function index()
    {

        $shopping_lists = Shopping_list::all();

        $orders = Order::all();

        $products = Product::all();
        $categories = Category::where('status', '!=', CategoryStatus::DISABLE)->get();
        $producers = Producer::where('status', '!=', ProducerStatus::DISABLE)->get();


        $users = User::all();
        return view('employeePanel.index', ['producers'=>$producers, 'categories'=>$categories, 'user'=>$users, 'products'=>$products, 'orders'=>$orders, 'shopping_lists'=>$shopping_lists]);
    }


}
