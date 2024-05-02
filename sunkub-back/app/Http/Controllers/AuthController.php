<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            "fname" => "required",
            "lname" => "required",
            "gender" => "required",
            "dob" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",         
        ]);

        // Author model
        User::create([
            "fname" => $request->fname,
            "lname" => $request->lname,
            "gender" => $request->gender,
            "dob" => $request->dob,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => "User created successfully"
        ]);
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
    
        if(Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ])){
            
             $user = Auth::user();
             $token = $user->createToken("myToken")->accessToken;
            return response()->json([
                "status" => true,
                "message" => "Login successful",
                "access_token" => $token
            ]);
        }
        return response()->json([
            "status" => false,
            "message" => "Invalid credentials"
        ]);
    }
}