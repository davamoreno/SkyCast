<?php

namespace App\Actions\Profile;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Inertia\Inertia;
use Inertia\Response;

class EditProfileAction
{
    use AsAction;

    /** 
    *   TAMPILKAN HALAMAN EDIT PROFILE
        * @param Request $request
        * @return Response
        */
    public function handle(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}