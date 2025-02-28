<?php

namespace App\Console\Commands;

use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Olifanton\Ton\Connect\ConnectItem;
use Olifanton\Ton\Connect\Connector;
use Olifanton\Ton\Connect\DefaultConnectionAwaiter;
use Olifanton\Ton\Connect\Request\ConnectRequest;
use Olifanton\Ton\Connect\TimeoutCancellation;
use Olifanton\Ton\Connect\WalletApplicationsManager;

class ConnectTonWallet extends Command
{
    protected $signature   = 'ton:connect-wallet';
    protected $description = 'Connect to the TON wallet via the TonConnect bridge';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $httpClient = new HttpMethodsClient(
            Psr18ClientDiscovery::find(),
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        define("PRECONNECT_STORAGE_FILE", storage_path("app/preconnect.json"));
        define("CONNECTED_INFO_FILE", storage_path("app/connected.json"));

        if (file_exists(PRECONNECT_STORAGE_FILE) && file_exists(CONNECTED_INFO_FILE)) {
            $this->error("Your wallet is already connected. Run `php artisan ton:send-transaction` example or delete the json files in the storage directory.");
//            return;
        }

        // Generating a unique connection identifier
        $preconnectedId = \Str::uuid(); // Replace with your own method of generating unique IDs
        $proofData      = json_encode([
                                          "p_id" => $preconnectedId,
                                          // Add any additional data if necessary
                                      ]);

        // Get predefined list of client apps
        $walletsApps = WalletApplicationsManager::getDefaultApps();

        // Creating a wallet connection request object
        $connectionRequest = new ConnectRequest(
//            "https://raw.githubusercontent.com/olifanton/olifanton.github.io/main/tonconnect-manifest.json",
            "https://backvpn.salimimlk.ir/manifest.json",
            ConnectItem::tonProof($proofData),
        );

        // Set up the storage
        $storage   = new \Olifanton\Ton\Connect\Storages\JsonFilePreconnectStorage(PRECONNECT_STORAGE_FILE);
        $connector = new Connector($storage, $httpClient); // Use HttpClient from Laravel if necessary

        // Get or ensure the sessions
        $sessions = $connector->ensureSessions($preconnectedId, $walletsApps);

        // Generate connection links
        $links = $connector->generateUniversalLinks($sessions, $connectionRequest, "none");

        foreach ($links as $appName => $link) {
            $this->info("$appName: $link");
        }

        // Set up awaiter for the connection process
        $awaiter = new DefaultConnectionAwaiter(
            $preconnectedId,
            new TimeoutCancellation(10 * 60), // 10 minutes timeout
            __DIR__ . "/background.php",
        );

        $awaiter->setLogger(Log::channel('daily')); // Laravel logging

        // Run the awaiter to check for the connection result
        $result = $awaiter->run($sessions, $storage);

        if ($result) {
            Log::info("Success!");
            Log::info("Customer wallet address: " . $result->tonAddr->getAddress()->toString(true, false));
            Log::info("Customer wallet app: " . $result->walletApplication->name);

            // Save connection data to database or storage
            $this->saveConnectionData($result);

            $this->info("Run `php artisan ton:send-transaction` for making a transaction request.");
        } else {
            Log::warning("Aborted by timeout.");
        }
    }

    private function saveConnectionData($result)
    {
        // Save the connection data to a file or database
        $data = [
            "preconnected_id" => $result->preconnectedId,
            "ton_addr"        => $result->tonAddr,
            "wallet"          => $result->walletApplication->appName,
            "features"        => $result->connectEvent->getDevice()->features,
        ];

        file_put_contents(CONNECTED_INFO_FILE, json_encode($data));
    }
}
