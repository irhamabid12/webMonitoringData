<?php

use Illuminate\Support\Facades\Route;



Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/actionRegister', 'App\Http\Controllers\RegistrationContoller@insert')->name('actionRegister');
Route::post('/actionLogin', 'App\Http\Controllers\LoginController@actionlogin')->name('actionLogin');
Route::get('/index' , function () {
    return view('index');
})->middleware('auth');

Route::group(['prefix'=>'index','as'=>'index.', 'middleware' => ['auth']], function () {
    Route::get('/account', 'App\Http\Controllers\AccountController@getAccount')->name('account');
});
