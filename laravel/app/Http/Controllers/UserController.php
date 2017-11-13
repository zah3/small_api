<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        $this->validate($request,[
                'name'  => 'required|max:100',
                'email' => 'required|email|unique:users',
            'password'  => 'required'
        ]);
        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Succesfully created new user'
        ],201);
    }
    public function signIn(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password'  => 'required'
        ]);
        $credit = $request->only('email','password');
        try{
            if(!$token = JWTAuth::attempt($credit))
                return response()->json([
                    'error' => 'Invalid credentials!'
                ],401);
        }catch(JWTException $e){
            return respnse()->json([
                'error' => 'Invalid token'
            ],500);
        }
        return response()->json([
            'token' => $token
        ],200);
    }
}
