<?php

namespace App\Actions\Auth;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class LoginAction
{
    use AsAction;

    /** 
    *   TAMPILKAN HALAMAN LOGIN (Method GET)
        * pengganti function create() di Controller lama
        * @param Request $request
        * @return Response
        */
    public function asController(Request $request): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /** 
    *   PROSES LOGIN (Method POST)
        * Ini pengganti function store() di Controller lama
        * @param LoginRequest $request
        * @return \Illuminate\Http\RedirectResponse
        */
    public function handle(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect ke dashboard App setelah login
        return redirect()->intended(route('dashboard', absolute: false));
    }
}