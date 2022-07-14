<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function Login(Request $request)
    {
        try {
            if (Auth::attempt($request->only('email','password'))){
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;
                return response([
                    'message'=>'User successfully login',
                    'token'=>$token,
                    'name'=>$user
                ],200);
            }

        }catch (Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }

        return response([
            'message'=>'Invalid email or password'
        ],401);

    }


    public function Register(RegisterRequest $request)
    {
        try{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            $token= $user->createToken('app')->accessToken;
            return response([
                'message'=>'User successfully created',
                'token'=>$token,
                'user'=>$user
            ],200);

        }catch (Exception $exception){
            return response([
                'message'=>'Error Occured'
            ],400);
        }
    }

}
