<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Session;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // ✅ Your custom logic
        // Example: Set role in session
        Session::put('user_role', 'admin'); //$user->role->name ?? 'guest'

        // Optional: Call a helper or do something else
        // \App\Helpers\AuthHelper::onSuccessfulLogin($user);

        return redirect()->intended(route('dashboard'));
    }
}
