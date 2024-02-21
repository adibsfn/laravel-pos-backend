<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Login API
    public function login(Request $request)
    {
        //VALIDATE
        $request->validate([
            'email' => 'required|email',
            'password' =>'required',
        ]);

        //CHECK IF THE USER EXISTS
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'user not found',
            ], 404);
        }

        //CHECK IF PASSWORD CORRECT
        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 404);
        }

        //GENERATE TOKEN
        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => $user
        ],200);


    }
}
