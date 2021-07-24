<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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

Route::group(['prefix' => '/v1'], function () {
    Route::group([
        'middleware' => 'api',
        'prefix' => '/auth'
    ], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
            ->name('password.request');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])
            ->name('password.reset');
    });

    Route::group(['prefix' => '/users'], function () {
        Route::post('', [UserController::class, 'store']);
    });

    Route::apiResource('vehicles', VehicleController::class);
});
