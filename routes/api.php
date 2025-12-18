<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\users\UserController;


Route::get('/users', [UserController::class , 'testApi']);


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',[AuthController::class , 'login']);
    Route::post('logout', 'AuthController@logout');
    Route::post('register', [AuthController::class , 'register']);
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
