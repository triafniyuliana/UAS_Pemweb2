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

    // public function __construct()
    // {
    //     $this->baseUrl = env('HUB_API_URL');
    //     $this->clientId = env('HUB_CLIENT_ID');
    //     $this->clientSecret = env('HUB_CLIENT_SECRET');
    //     $this->client = new Client([
    //         'base_uri' => $this->baseUrl,
    //         'headers' => [
    //             'Accept' => 'application/json',
    //         ],
    //         'verify' => false, // Hanya untuk pengembangan lokal
    //     ]);
    // }

    /**
     * Mendapatkan token akses dari Hub.
     */
    public function getAccessToken()
    {
        try {
            $response = $this->client->post('oauth/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => '*',
                ],
            ]);

            $data = json_decode((string) $response->getBody(), true);
            return $data['access_token'] ?? null;
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Gagal mendapatkan token akses dari Hub: ' . $e->getMessage());
            throw new \Exception('Tidak bisa mendapatkan token akses dari Hub');
        }
    }

    /**
     * Update visibilitas produk di Hub.
     */
    public function updateProductVisibility($productId, array $data)
    {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->put("products/{$productId}/visibility", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => $data,
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client Error saat update visibilitas: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Gagal update visibilitas produk: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Sinkron produk ke Hub.
     */
    public function createProduct($data)
    {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->post('products', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => $data,
            ]);

            $responseData = json_decode((string) $response->getBody(), true);

            // Tambahkan log/cek response
            Log::info('Response dari Hub (createProduct): ', $responseData);

            return $responseData;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client Error saat membuat produk: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Gagal membuat produk di Hub: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Hapus produk dari Hub.
     */
    public function deleteProduct($productId)
    {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->delete("products/{$productId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client Error saat hapus produk: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Gagal hapus produk dari Hub: ' . $e->getMessage());
            throw $e;
        }
    }
}
