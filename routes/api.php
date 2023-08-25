<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SiteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::post('signup', 'signup');

    Route::middleware('auth:api')->group(function() {
        Route::get('logout', 'logout');
        Route::get('user', 'user');
    });
});

Route::apiResource('sites', SiteController::class)->only([
    'index', 'show'
]);

Route::middleware('auth:api')->group( function () {
    Route::apiResource('sites', SiteController::class)->except([
        'index', 'show'
    ]);
});
