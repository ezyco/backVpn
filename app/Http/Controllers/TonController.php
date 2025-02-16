<?php

namespace App\Http\Controllers;

use App\Services\TonService;
use Illuminate\Http\Request;

class TonController extends Controller
{
    protected $tonService;

    public function __construct(TonService $tonService)
    {
        $this->tonService = $tonService;
    }

    public function getTransactions(Request $request)
    {
        $request->validate(['wallet' => 'required|string']);
        $balance = $this->tonService->getTransactions($request);
        return response()->json($balance);
    }
    public function getBalance(Request $request)
    {
        $request->validate(['wallet' => 'required|string']);
        $balance = $this->tonService->getWalletBalance($request->wallet);
        return response()->json($balance);
    }

    // Verify Transaction
    public function verifyTransaction(Request $request)
    {
        $request->validate(['txHash' => 'required|string']);
        $transaction = $this->tonService->verifyTransaction($request->txHash);
        return response()->json($transaction);
    }
}
