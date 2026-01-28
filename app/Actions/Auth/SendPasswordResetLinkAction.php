<?php

namespace App\Actions\Auth;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Inertia\Response;

class SendPasswordResetLinkAction
{
    use AsAction;

    /**
     *  HALAMAN FORM RESET PASSWORD (GET)
        * @return Response
        */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /** 
     *  KIRIM EMAIL RESET (POST)
        * @param Request $request
        * @return \Illuminate\Http\RedirectResponse
        */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Kirim link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}