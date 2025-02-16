<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use kornrunner\Keccak;

class TonAuthService
{
    /**
     * Verify wallet signature and authenticate user
     */
    public function authenticateUser($walletAddress, $publicKey, $signature, $message)
    {
        $hashedMessage = Keccak::hash($message, 256);

        $user = User::query()->firstOrCreate(
            ['wallet_address' => $walletAddress],
            ['public_key' => $publicKey]
        );

        // Generate API token
        $token = $user->createToken('auth_token')->accessToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
