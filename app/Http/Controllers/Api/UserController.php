<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){
        $validatedCredentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($validatedCredentials)){
            $user = Auth::user();
            $accessToken = $user->createToken('authToken')->accessToken;

            return response()->json(['user' => $user,'accessToken' => $accessToken]);
        }
    }
}
