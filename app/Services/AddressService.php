<?php

namespace App\Services;

use App\Services\Integration\BrasilAPIService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AddressService
{
    public function __construct(
        protected BrasilAPIService $brasilAPI
    ) {}

    /**
     * Handle the ZIP code lookup with fallback logic.
     *
     * @param string $zipCode
     * @return array|false
     */
    public function handle(string $zipCode): array|false
    {
        $zipCode = preg_replace('/[^0-9]/', '', $zipCode);

        if (strlen($zipCode) !== 8) {
            return false;
        }

        // Try BrazilAPI first
        $data = $this->lookupBrazilApi($zipCode);

        if ($data) {
            return $data;
        }

        // Fallback to ViaCEP
        $data = $this->lookupViaCep($zipCode);

        if ($data) {
            return $data;
        }

        return false;
    }

    /**
     * Lookup address using BrazilAPI.
     */
    protected function lookupBrazilApi(string $zipCode): array|false
    {
        $data = $this->brasilAPI->getCep($zipCode);

        if ($data) {
            return [
                'zip_code' => $data['cep'],
                'street' => $data['street'] ?? null,
                'neighborhood' => $data['neighborhood'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
            ];
        }

        return false;
    }

    /**
     * Lookup address using ViaCEP (fallback).
     */
    protected function lookupViaCep(string $zipCode): array|false
    {
        try {
            $response = Http::get("https://viacep.com.br/ws/{$zipCode}/json/");

            if ($response->successful() && !isset($response->json()['erro'])) {
                $data = $response->json();
                return [
                    'zip_code' => $data['cep'],
                    'street' => $data['logradouro'] ?? null,
                    'neighborhood' => $data['bairro'] ?? null,
                    'city' => $data['localidade'] ?? null,
                    'state' => $data['uf'] ?? null,
                ];
            }
        } catch (\Exception $e) {
            Log::channel('daily')->error('ViaCEP Error: ' . $e->getMessage(), [
                'zip_code' => $zipCode,
                'exception' => $e,
            ]);
        }

        return false;
    }
}
