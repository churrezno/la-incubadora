<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $user = auth()->user();
        
        if ( $user->hasRole('admin') )
        {
            return redirect()->route('admin.index');
        }
        else if ( $user->hasRole('comite') )
        {
            return redirect()->route('inscripciones.index');
        }
        else
        {
            return redirect()->route('home');
            //return redirect()->route('convo-closed');
        }

        
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }

}