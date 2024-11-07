<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RoleController extends Controller
{
    public function index(){
        $restaurants = Restaurant::all();
        $users = User::query()->orderby('id')->get();
        return view('admin.role.index',compact('restaurants','users'));
    }

    public function create(){
        $restaurants = Restaurant::all();
        $roles = Role::all();
        $users= User::all();
        return view('admin.role.create',compact('restaurants','roles','users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required|exists:roles,id',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'restaurant_id' => $request->restaurant_id,
        ]);

        event(new Registered($user));

        return redirect()->route('role.index')->with('success', 'Role created successfully');
    }

}
