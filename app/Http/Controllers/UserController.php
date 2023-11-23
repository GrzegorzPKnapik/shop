<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Role;
use App\Models\Shopping_list;
use App\Models\Status;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', ['users'=>$users]);
    }


    public function updateRole(User $user, Request $request)
    {

        $user->role()->associate(Role::where('id',  $request->select)->first())->save();
        return redirect(route('user.index'));
    }

    public function editRole(User $user)
    {
        $roles = Role::all();
        return view('user.editRole',['user'=>$user, 'roles'=>$roles]);
    }



}
