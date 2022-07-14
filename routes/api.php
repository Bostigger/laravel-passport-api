<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login',[AuthController::class,'Login']);

Route::post('/register',[AuthController::class,'Register']);

Route::post('/forget-password',[ForgetPasswordController::class,'ForgetPassword']);

Route::post('/reset-password',[ResetPasswordController::class,'ResetUserPassword']);

Route::get('/user',[UserController::class,'user'])->middleware('auth:api');
