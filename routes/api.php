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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cars', \App\Http\Controllers\Api\CarController::class)
    ->middleware(['web']);

Route::controller(\App\Http\Controllers\Api\RentCarController::class)
    ->middleware(['web'])
    ->group(static function () {
        Route::get('/available-cars', 'availableCars');
        Route::post('/attach/{car}/{user?}', 'attach');
        Route::post('/detach/{car}', 'detach');
    });

