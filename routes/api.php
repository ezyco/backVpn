<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TonController;
use Illuminate\Support\Facades\Route;

Route::prefix('ton')->group(function () {
    Route::post('auth', [AuthController::class, 'authenticate']);
    Route::get('getTransactions', [TonController::class, 'getTransactions']);
    Route::get('getBalance', [TonController::class, 'getBalance']);
    Route::get('transaction', [TonController::class, 'verifyTransaction']);
});
Route::prefix('configs')->group(function () {

});
