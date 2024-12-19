<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\AdminManagement\Admins\Http\Controllers\AdminController;

Route::get('index' , [AdminController::class, 'index']);

Route::get('index-trash' , [AdminController::class, 'indexTrash']);

Route::get('export' , [AdminController::class, 'export']);

Route::get('/show/{user}' , [AdminController::class, 'show']);

Route::post('create' , [AdminController::class, 'create']);

Route::put('update/{user}' , [AdminController::class, 'update']);

Route::delete('delete/{user}' , [AdminController::class, 'delete']);

Route::post('restore/{id}' , [AdminController::class, 'restore']);
