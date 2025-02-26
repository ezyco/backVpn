<?php

namespace App\Http\Controllers;

use App\Services\TonAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $tonAuthService;

    public function __construct(TonAuthService $tonAuthService)
    {
        $this->tonAuthService = $tonAuthService;
    }

    public function authenticate(Request $request)
    {
        $request->validate([
                               'wallet_address' => 'required|string',
                               'public_key'     => 'string',
                               'signature'      => 'string',
                               'message'        => 'string',
                           ]);

        $authResult = $this->tonAuthService->authenticateUser(
            $request->wallet_address,
            $request->public_key,
            $request->signature,
            $request->message,
        );

        return response()->json($authResult);
    }
}
