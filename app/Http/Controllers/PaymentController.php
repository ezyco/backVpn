<?php

namespace App\Http\Controllers;

use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Illuminate\Http\Request;
use Olifanton\Ton\Transports\Toncenter\ClientOptions;
use Olifanton\Ton\Transports\Toncenter\ToncenterHttpV2Client;
use Olifanton\Ton\Transports\Toncenter\ToncenterTransport;

class PaymentController extends Controller
{
    public function init()
    {
        $isMainnet       = false;
        $toncenterApiKey = env('TONCENTER_API_KEY_MAINNET');

        $httpClient = new HttpMethodsClient(
            Psr18ClientDiscovery::find(),
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
        );

        $toncenter = new ToncenterHttpV2Client(
            $httpClient,
            new ClientOptions(
                $isMainnet
                    ? "https://toncenter.com/api/v2"
                    : "https://testnet.toncenter.com/api/v2",
                $toncenterApiKey,
            ),
        );

        $toncenterTransport = new ToncenterTransport($toncenter);


//        $toncenterTransport->send($someBoc);
    }

    public function payment()
    {
        return 'asdw';
        return \request()->user();
        return 'asd';
    }
}
