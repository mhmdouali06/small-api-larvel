<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;


class AuthController extends Controller

{
    
    public function login(Request $request)
    {
        $message=[
            'email.required' => 'Email is required',
        ];
       $validator= Validator::make($request->all(), [
           'email' => 'required|email',
           'password' => 'required|string|min:6',
       ],$message);
      
     if($validator->fails() ){
        return response()->json([
            $validator->errors(),422
        ]);
     }
     if(! $token = auth()->attempt($validator->validated())){
        return response()->json(['error' => 'Unauthorized'], 401);
     }
     return $this->createNewToken($token);
    }
    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            "expires_in" => Auth ::factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}
