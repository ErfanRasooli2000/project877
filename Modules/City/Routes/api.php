<?php

// Define your routes here

use Illuminate\Support\Facades\Route;
use Modules\City\Http\Controllers\CityController;
use Modules\City\Http\Controllers\ProvinceController;

Route::get('provinces' , [ProvinceController::class , 'getAll']);

Route::get('cities-in-province/{province}' , [CityController::class , 'getCitiesByProvince']);
