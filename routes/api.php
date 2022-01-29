<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/users', [App\Http\Controllers\Api\UsersController::class, 'index']);
    Route::get('/users/{user}', [App\Http\Controllers\Api\UsersController::class, 'show']);
    Route::post('/users', [App\Http\Controllers\Api\UsersController::class, 'create']);
    Route::delete('/users/{user}', [App\Http\Controllers\Api\UsersController::class, 'delete']);
    Route::put('/users/{user}/update', [App\Http\Controllers\Api\UsersController::class, 'update']);
});




