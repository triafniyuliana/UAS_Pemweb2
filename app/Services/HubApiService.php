<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HubApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.hub.base_url'),
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . config('services.hub.token'),
            ],
        ]);
    }

    public function updateProductVisibility($hubProductId, $isVisible)
    {
        try {
            $response = $this->client->put("/products/{$hubProductId}/visibility", [
                'json' => [
                    'is_visible' => $isVisible
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Gagal update visibilitas produk di Hub: ' . $e->getMessage());
            return null;
        }
    }
}
