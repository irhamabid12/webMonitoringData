<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/insertData', 'App\Http\Controllers\DataMonitoringController@insertData');
Route::get('/connection', 'App\Http\Controllers\DataMonitoringController@connection');
Route::get('/gpsdata', 'App\Http\Controllers\DataMonitoringController@gpsdata');