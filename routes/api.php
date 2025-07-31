<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::get('{contact}', [ContactController::class, 'show']);
    Route::post('/', [ContactController::class, 'store']);
    Route::put('{contact}', [ContactController::class, 'update']);
    Route::delete('{contact}', [ContactController::class, 'destroy']);
});

Route::group(['prefix' => 'meetings'], function () {
    Route::get('/', [MeetingController::class, 'index']);
    Route::get('{meeting}', [MeetingController::class, 'show']);
    Route::post('/', [MeetingController::class, 'store']);
    Route::put('{meeting}', [MeetingController::class, 'update']);
    Route::delete('{meeting}', [MeetingController::class, 'destroy']);
});