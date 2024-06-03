<?php

namespace App\Service;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class VaultService
{
    protected $client;
    protected $vaultAddr;
    protected $vaultToken;

    public function __construct() {
        $this->vaultAddr = config('services.vault.addr');
        $this->vaultToken = config('services.vault.token');
        $this->client = new Client([
            'base_uri' => $this->vaultAddr,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->vaultToken,
            ],
        ]);
    }

    public function getSecret($path)
    {
        try {
            $response = $this->client->request('GET', 'v1/' . $path);
            $data = json_decode($response->getBody(), true);
            return $data['data'] ?? null;
        } catch (GuzzleException $e) {
            throw new \Exception("Error retrieving secret: " . $e->getMessage());
        }
    }

}


?>