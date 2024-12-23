<?php

use Illuminate\Support\Facades\Route;
use Modules\User\UserAcl\Auth\Http\Controllers\AuthController;

Route::post('send-otp-code' , [AuthController::class , 'sendOtpCode']);

Route::post('login' , [AuthController::class , 'login']);

Route::post('register' , [AuthController::class , 'register']);

Route::post('logout' , [AuthController::class , 'logout'])->middleware('auth:sanctum');
