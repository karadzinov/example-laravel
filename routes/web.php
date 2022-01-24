<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});






Auth::routes();



Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/create-status',  [App\Http\Controllers\HomeController::class, 'createStatus'])->name('create.status');

    Route::post('/status/{status}/like',  [App\Http\Controllers\HomeController::class, 'likeStatus'])->name('like.status');
    Route::post('/status/{status}/unlike',  [App\Http\Controllers\HomeController::class, 'unlike'])->name('unlike.status');


    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::get('/users/{user}/products', [App\Http\Controllers\UserController::class, 'getProducts'])->name('user.products');

    Route::resource('/products', App\Http\Controllers\ProductsController::class);
});


Route::group(['middleware' => ['role:Administrator', 'auth']], function() {
    Route::get('/role', [App\Http\Controllers\HomeController::class, 'checkRole'])->name('check.role');
});









// PUT = PATCH

// DELETE

// GET

// POST


