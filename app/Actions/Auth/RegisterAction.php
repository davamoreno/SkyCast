<?php

namespace App\Actions\Auth;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisterAction
{
    use AsAction;

    /** 
    *   TAMPILKAN HALAMAN REGISTER
        * @return Response
        */
    public function handle() : Response
    {
        return Inertia::render('Auth/Register');
    }

    /** 
    *  PROSES REGISTER USER
        * @param Request $request
        * @return \Illuminate\Http\RedirectResponse
        */
    public function asController(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('weather', absolute: false));
    }
}
