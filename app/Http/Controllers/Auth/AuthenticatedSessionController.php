<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return $this->redirectToDashboard(Auth::user());



    }

    public function redirectToDashboard($user): RedirectResponse
    {
        if ($user->isAdmin()) {
            return redirect('admin/dashboard');
        }
        elseif ($user->isChef()){
            return redirect('chef/dashboard');
        }
        elseif ($user->isManager()){
            return redirect('manager/dashboard');
        }
        else{
            return redirect('/');
        }
    }

//    public function chefStore(LoginRequest $request): RedirectResponse{
//
//        $request->authenticate();
//        $request->session()->regenerate();
//        $user = Auth::user();
//
//        if ($user->isChef()) {
//            return redirect()->route('chef.dashboard');
//        } else {
//            return redirect()->route('dashboard');
//        }
//    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
