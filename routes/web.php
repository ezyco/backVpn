<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TonController;
use Illuminate\Support\Facades\Route;

Route::get('/ton/getTransactions', [TonController::class, 'getTransactions']);
Route::get('/ton/balance', [TonController::class, 'getBalance']);
Route::get('/ton/transaction', [TonController::class, 'verifyTransaction']);
Route::post('/auth/ton', [AuthController::class, 'authenticate']);
