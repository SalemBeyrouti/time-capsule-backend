<?php

namespace App\Services\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    static function login(Request $request) {
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string',
        ]);
        $credentials = $requst->

    }
    
    
}
