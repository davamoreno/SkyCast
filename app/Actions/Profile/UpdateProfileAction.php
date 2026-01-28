<?php

namespace App\Actions\Profile;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UpdateProfileAction
{
    use AsAction;

    /**
     * UPDATE PROFILE (PATCH)
        * @param ProfileUpdateRequest $request
        * @return \Illuminate\Http\RedirectResponse
        */
    public function handle(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }
}