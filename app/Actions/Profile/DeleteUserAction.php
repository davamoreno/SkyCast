<?php

namespace App\Actions\Profile;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DeleteUserAction
{
    use AsAction;

    /**
     * DELETE USER (DELETE)
        * @param Request $request
        * @return \Illuminate\Http\RedirectResponse
        */
    public function handle(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}