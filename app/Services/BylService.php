<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class BylService
{
    protected $client;
    protected $token;

    public function __construct()
    {
        $this->token = env('BYL_TOKEN');

        $this->client = new Client([
            'base_uri' => env('BYL_BASE_URL'),
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
        ]);
    }


    public function createInvoice($amount, $description, $autoAdvance )
    {

            $response = $this->client->post('invoices', [
                'json' => [
                    'amount'       => $amount,
                    'description'  => $description,
                    'auto_advance' => $autoAdvance,
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
    }
}
