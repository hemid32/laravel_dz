<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
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
    Route::post('register', [AuthController::class , 'register']);

});


Route::group([

    'middleware' => ['api-require' , 'jwt.auth'],
    'prefix' => 'auth'

], function ($router) {

    //updateProfile
    Route::post('updateprofile',[AuthController::class , 'updateProfile']);
    Route::post('logout', [AuthController::class , 'logout']);
    Route::get('me', [AuthController::class , 'me']);
});


Route::group([

    'middleware' =>[ 'api-require', 'jwt.auth' ],
        'prefix' => 'course'


], function ($router) {

    Route::post( 'completecourse', [CourseController::class , 'completeCourse']);
    Route::get('getCourses', [CourseController::class , 'getCoursesOfType']);
    //
    Route::get('getDetailCourse', [CourseController::class , 'getDetailCourse']);
    //getTypecourses
    Route::get('getTypecourses', [CourseController::class , 'getTypecourses']);
});