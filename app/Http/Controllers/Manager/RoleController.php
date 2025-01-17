<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RoleController extends Controller
{
    public function index(){
        $users = User::where('restaurant_id', Auth::user()->restaurant_id)->get();
        return view('manager.role.index',compact('users'));
    }

    public function create(){
        $roles = Role::all();
        $users= User::all();
        return view('manager.role.create',compact('roles','users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required|exists:roles,id',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'restaurant_id' => Auth::user()->restaurant_id,
        ]);

        event(new Registered($user));

        return redirect()->route('manager.role.index')->with('success', 'Role created successfully');
    }
    public function destroy($id)
    {
        $users=User::query()->find($id);
        $users->delete();
        return redirect()->route('manager.role.index')->with('success', 'Role deleted successfully');
    }
}
