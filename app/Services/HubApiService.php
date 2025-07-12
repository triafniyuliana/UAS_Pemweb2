<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HubApiService
{
    protected $client;
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->baseUrl = env('HUB_API_URL');
        $this->clientId = env('HUB_CLIENT_ID');
        $this->clientSecret = env('HUB_CLIENT_SECRET');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json',
            ],
            'verify' => false // HANYA untuk development!
        ]);
    }

    /**
     * Ambil access token dari Hub via client_credentials grant
     */
    public function getAccessToken()
    {
        try {
            $response = $this->client->post('oauth/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => '*'
                ]
            ]);

            $data = json_decode((string) $response->getBody(), true);
            return $data['access_token'];
        } catch (\Exception $e) {
            Log::error('Gagal mendapatkan token dari Hub: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Ubah visibilitas produk di Hub (On/Off)
     */
    public function updateProductVisibility($productId, array $data)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['message' => 'Gagal ambil token dari Hub'], 500);
        }

        try {
            $response = $this->client->put("products/{$productId}/visibility", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => $data,
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client Error update visibilitas: ' . $e->getMessage() . ' Response: ' . $e->getResponse()->getBody());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error update visibilitas produk di Hub: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Sinkronkan produk baru ke Hub
     */
    public function createProduct($data)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['message' => 'Gagal ambil token dari Hub'], 500);
        }

        try {
            $response = $this->client->post('products', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => $data,
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client Error buat produk di Hub: ' . $e->getMessage() . ' Response: ' . $e->getResponse()->getBody());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error saat membuat produk di Hub: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Hapus produk dari Hub
     */
    public function deleteProduct($productId)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['message' => 'Gagal ambil token dari Hub'], 500);
        }

        try {
            $response = $this->client->delete("products/{$productId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client Error hapus produk di Hub: ' . $e->getMessage() . ' Response: ' . $e->getResponse()->getBody());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error hapus produk di Hub: ' . $e->getMessage());
            throw $e;
        }
    }
}
