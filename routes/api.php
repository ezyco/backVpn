<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TonController;
use Illuminate\Support\Facades\Route;

//Route::middleware(['ApiHeaderMiddleware','api','auth'])->group(function () {
Route::prefix('ton')->group(function () {
    Route::post('auth', [AuthController::class, 'authenticate']);
    Route::get('getTransactions', [TonController::class, 'getTransactions']);
    Route::get('getBalance', [TonController::class, 'getBalance']);
    Route::get('transaction', [TonController::class, 'verifyTransaction']);
    Route::prefix('payment')/*->middleware(['auth:sanctum'])*/->group(function () {
        Route::get('', [PaymentController::class, 'payment']);
    });
});
Route::prefix('configs')->group(function () {
    Route::get('', [ConfigController::class, 'index']);
});
Route::prefix('subscriptions')->group(function () {
    Route::get('', [SubscriptionController::class, 'index']);
});
//});
