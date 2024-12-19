<?php

use Illuminate\Support\Facades\Route;
use Modules\Acl\RolePermissions\Http\Controllers\RoleController;

Route::get('index' , [RoleController::class , 'index']);

Route::post('create' , [RoleController::class , 'create']);

Route::get('show/{role}' , [RoleController::class , 'show']);

Route::put('update/{role}' , [RoleController::class , 'update']);

Route::get('permissions' , [RoleController::class , 'permissions']);
