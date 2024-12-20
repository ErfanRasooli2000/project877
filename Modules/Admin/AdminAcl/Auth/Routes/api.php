<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\AdminAcl\Auth\Http\Controllers\AuthController;

Route::post('register-get-otp' , [AuthController::class , 'registerGetOtp']);

Route::post('register' , [AuthController::class , 'register']);

Route::post('send-login-code' , [AuthController::class , 'sendLoginCode']);

Route::post('login' , [AuthController::class , 'login']);

Route::post('logout' , [AuthController::class , 'logout'])->middleware('auth:sanctum');
