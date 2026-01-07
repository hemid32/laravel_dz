<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AdminController::class , 'loginView'])->name('login');
//loginadmin
Route::post('/loginadmin', [AdminController::class , 'login'])->name('loginadmin');

Route::get('/', function () {
    return view('welcome');
});



Route::group([
    'middleware'=> ['auth', 'admin-require' ]   , 
] , function ($router){

    Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->name('admin.dashboard');


Route::get('/logout', [AdminController::class , 'logout'])->name('logout');


Route::get('/typecourse', action: [AdminController::class , 'typecourse'])->name('typecourse');

Route::get('/contentcourse', action: [AdminController::class , 'contentcourse'])->name('contentcourse');
Route::post('/contentcoursesave', action: [AdminController::class , 'contentcoursesave'])->name('contentcoursesave');

//coursesave
Route::get('/course', action: [AdminController::class , 'course'])->name('course');




Route::post('/coursesave', [AdminController::class , 'coursesave'])->name('coursesave');

Route::post('/typesave', [AdminController::class , 'typesave'])->name('typesave');


}) ; 


