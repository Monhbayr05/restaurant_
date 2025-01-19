<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class BylService
{
    protected $client;
    protected $projectId;
    protected $token;

    public function __construct()
    {
        $this->projectId = env('BYL_PROJECT_ID'); 
        $this->token     = env('BYL_API_KEY');    
        $baseUrl         = env('BYL_BASE_URL', 'https://byl.mn');

        if (!$this->projectId || !$this->token) {
            Log::warning('BylService initialized without valid project ID or token. Check .env');
        }

        $this->client = new Client([
            'base_uri' => $baseUrl . '/api/v1/projects/' . $this->projectId . '/',
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
        ]);
    }

    /**
     * Create a new Byl invoice.
     *
     * @param  float|int  $amount
     * @param  string     $description
     * @param  bool       $autoAdvance
     * @return array      ['success' => bool, 'data' => ... , 'message' => ... ]
     */
    public function createInvoice($amount, $description, $autoAdvance )
    {
        try {
            $response = $this->client->post('invoices', [
                'json' => [
                    'amount'       => $amount,
                    'description'  => $description,
                    'auto_advance' => $autoAdvance,
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return [
                'success' => true,
                'data'    => $data['data'] ?? [],
                'message' => 'Invoice created successfully',
            ];

        } catch (GuzzleException $e) {

            Log::error('BylService createInvoice error: ' . $e->getMessage());


            return [
                'success' => false,
                'data'    => null,
                'message' => $e->getMessage(),
            ];
        }
    }
}
