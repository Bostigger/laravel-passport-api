<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPwdRequest;
use App\Mail\ForgetMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{

    public function ForgetPassword(ForgetPwdRequest $request)
    {

        $email = $request->email;
        try {
            if(User::where('email',$email)->doesntExist()){
               return response([
                   'message'=>'Email not found'
               ],401);
            }
            $token = Rand(10,100000);

            DB::table('password_resets')->insert([
                'email'=>$email,
                'token'=>$token,
            ]);

           Mail::to($email)->send(new ForgetMail($token));
           return response([
               'message'=>'Password reset mail sent to your mail. Kindly check.'
           ]);
        }catch (Exception $exception){
            return response([
               'message'=>$exception->getMessage()
            ],400);
        }
    }

}
