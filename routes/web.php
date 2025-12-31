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


Route::get('/typecourse', [AdminController::class , 'typecourse'])->name('typecourse');
//typesave
Route::post('/typesave', [AdminController::class , 'typesave'])->name('typesave');


}) ; 


