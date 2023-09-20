<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'apple', 'excluded_middleware' => 'throttle:api'], function () {
    Route::post('purchase', [\App\Http\Controllers\ApiController::class, 'purchase']);
    Route::post('check', [\App\Http\Controllers\ApiController::class, 'check']);
});

Route::group(['prefix' => 'google', 'excluded_middleware' => 'throttle:api'], function () {
    Route::post('purchase', [\App\Http\Controllers\ApiController::class, 'purchase']);
    Route::post('check', [\App\Http\Controllers\ApiController::class, 'check']);
});
