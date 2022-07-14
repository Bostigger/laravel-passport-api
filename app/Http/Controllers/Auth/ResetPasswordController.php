<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{
    public function ResetUserPassword(ResetPasswordRequest $request)
    {
        $token = $request->token;
        $email = $request->email;
        $password = Hash::make($request->password);

        $email_chk = DB::table('password_resets')->where('email', $email)->first();
        $token_chk = DB::table('password_resets')->where('token', $token)->first();

        if (!$email_chk) {
            return response([
                'message' => 'Email not found'
            ], 401);
        }

        if (!$token_chk) {
            return response([
                'message' => 'Pincode invalide'
            ], 401);
        }
        User::where('email',$email)->update([
           'password'=>$password,
        ]);
        DB::table('password_resets')->where('email', $email)->delete();
        DB::table('password_resets')->where('token', $token)->delete();
        return response([
            'message' => 'Password Successfully changed'
        ], 200);
    }
}


