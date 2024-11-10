<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Users\Http\Controllers\UserController;

Route::get('index' , [UserController::class, 'index']);

Route::get('index-trash' , [UserController::class, 'indexTrash']);

Route::get('export' , [UserController::class, 'export']);

Route::get('/show/{user}' , [UserController::class, 'show']);

Route::post('create' , [UserController::class, 'create']);

Route::put('update/{user}' , [UserController::class, 'update']);

Route::delete('delete/{user}' , [UserController::class, 'delete']);

Route::post('restore/{id}' , [UserController::class, 'restore']);
