<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\users\UserController;
use App\Http\Middleware\ApiKeyMiddleware;

Route::get('/users', [UserController::class , 'testApi']);


Route::group([

    'middleware' => 'api-require',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',[AuthController::class , 'login']);
    //updateProfile
    Route::post('updateprofile',[AuthController::class , 'updateProfile']);

    Route::post('logout', [AuthController::class , 'logout']);
    Route::post('register', [AuthController::class , 'register']);
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', [AuthController::class , 'me']);

});
