<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
});

Route::group(['prefix' => 'subscriptions'], function () {
    Route::post('purchase', [\App\Http\Controllers\PurchaseController::class, 'purchase']);
    Route::post('check', [\App\Http\Controllers\PurchaseController::class, 'check']);
});
