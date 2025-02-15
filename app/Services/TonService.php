<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TonService
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = config('ton.api_url'); // Fetch from config
        $this->apiKey = config('ton.api_key'); // Fetch from .env
    }

    public function getTransactions(Request $request)
    {
        try {
            $walletAddress = $request->input('address');
            $limit         = $request->input('limit');
//            dd($walletAddress,$limit);
            $response      = $this->client->get("{$this->apiUrl}/getTransactions?address={$walletAddress}&limit={$limit}&to_lt=0&archival=true", [
                'headers' => [
                    'X-API-Key' => $this->apiKey,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data ?? null;
        } catch (\Exception $e) {
            Log::error('TON API Error: ' . $e->getMessage());
            return null;
        }
    }

    public function getWalletBalance($walletAddress)
    {
        try {
            $response = $this->client->get("{$this->apiUrl}/getAddressBalance?address={$walletAddress}", [
                'headers' => [
                    'X-API-Key' => $this->apiKey,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data ?? null;
        } catch (\Exception $e) {
            Log::error('TON API Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Verify TON Transaction
     */
    public function verifyTransaction($txHash)
    {
        try {
            $response = $this->client->get("{$this->apiUrl}/getTransaction?hash={$txHash}", [
                'headers' => [
                    'X-API-Key' => $this->apiKey,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (\Exception $e) {
            Log::error('TON Transaction Error: ' . $e->getMessage());
            return null;
        }
    }
}
