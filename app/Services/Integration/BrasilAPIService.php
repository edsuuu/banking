<?php

namespace App\Services\Integration;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrasilAPIService
{
    private const BASE_URL = 'https://brasilapi.com.br/api';
    private const TIMEOUT = 10;

    // Cache TTLs
    private const BANKS_CACHE_TTL = 86400; // 24 horas
    private const CEP_CACHE_TTL = 604800;  // 7 dias

    // Cache keys
    private const BANKS_CACHE_KEY = 'brasil_api_banks';

    /**
     * Busca endereço por CEP
     */
    public function getCep(string $cep): ?array
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (strlen($cep) !== 8) {
            return null;
        }

        $cacheKey = "brasil_api_cep_{$cep}";

        return Cache::remember($cacheKey, self::CEP_CACHE_TTL, function () use ($cep) {
            try {
                $response = Http::timeout(self::TIMEOUT)
                    ->get(self::BASE_URL . "/cep/v1/{$cep}");

                if ($response->successful()) {
                    $data = $response->json();

                    return [
                        'cep' => $data['cep'] ?? $cep,
                        'street' => $data['street'] ?? null,
                        'neighborhood' => $data['neighborhood'] ?? null,
                        'city' => $data['city'] ?? null,
                        'state' => $data['state'] ?? null,
                    ];
                }

                return null;
            } catch (\Exception $e) {
                Log::channel('daily')->warning('BrasilAPI CEP Error: ' . $e->getMessage(), [
                    'cep' => $cep,
                    'exception' => $e,
                ]);

                return null;
            }
        });
    }

    /**
     * Busca todos os bancos
     */
    public function getBanks(): Collection
    {
        return Cache::remember(self::BANKS_CACHE_KEY, self::BANKS_CACHE_TTL, function () {
            try {
                $response = Http::timeout(self::TIMEOUT)
                    ->get(self::BASE_URL . '/banks/v1');

                if ($response->successful()) {
                    return collect($response->json())
                        ->filter(fn($bank) => $bank['code'] !== null)
                        ->map(fn($bank) => [
                            'code' => str_pad((string) $bank['code'], 3, '0', STR_PAD_LEFT),
                            'name' => $bank['name'],
                            'fullName' => $bank['fullName'] ?? $bank['name'],
                            'ispb' => $bank['ispb'],
                        ])
                        ->sortBy('code')
                        ->values();
                }

                return $this->getFallbackBanks();
            } catch (\Exception $e) {
                Log::channel('daily')->warning('BrasilAPI Banks Error: ' . $e->getMessage(), ['exception' => $e]);

                return $this->getFallbackBanks();
            }
        });
    }

    /**
     * Busca bancos por termo (código ou nome)
     */
    public function searchBanks(string $term): Collection
    {
        $term = strtolower(trim($term));

        if (empty($term)) {
            return collect();
        }

        return $this->getBanks()
            ->filter(function ($bank) use ($term) {
                return str_contains(strtolower($bank['code']), $term)
                    || str_contains(strtolower($bank['name']), $term)
                    || str_contains(strtolower($bank['fullName']), $term);
            })
            ->take(20)
            ->values();
    }

    /**
     * Busca banco por código
     */
    public function getBankByCode(string $code): ?array
    {
        $code = str_pad($code, 3, '0', STR_PAD_LEFT);

        return $this->getBanks()->firstWhere('code', $code);
    }

    /**
     * Limpa cache de bancos
     */
    public function clearBanksCache(): void
    {
        Cache::forget(self::BANKS_CACHE_KEY);
    }

    /**
     * Limpa cache de CEP específico
     */
    public function clearCepCache(string $cep): void
    {
        $cep = preg_replace('/\D/', '', $cep);
        Cache::forget("brasil_api_cep_{$cep}");
    }

    /**
     * Lista de bancos mais comuns como fallback
     */
    private function getFallbackBanks(): Collection
    {
        return collect([
            ['code' => '001', 'name' => 'BCO DO BRASIL S.A.', 'fullName' => 'Banco do Brasil S.A.', 'ispb' => '00000000'],
            ['code' => '033', 'name' => 'BCO SANTANDER (BRASIL) S.A.', 'fullName' => 'BANCO SANTANDER (BRASIL) S.A.', 'ispb' => '90400888'],
            ['code' => '104', 'name' => 'CAIXA ECONOMICA FEDERAL', 'fullName' => 'CAIXA ECONOMICA FEDERAL', 'ispb' => '00360305'],
            ['code' => '237', 'name' => 'BCO BRADESCO S.A.', 'fullName' => 'Banco Bradesco S.A.', 'ispb' => '60746948'],
            ['code' => '341', 'name' => 'ITAÚ UNIBANCO S.A.', 'fullName' => 'ITAÚ UNIBANCO S.A.', 'ispb' => '60701190'],
            ['code' => '260', 'name' => 'NU PAGAMENTOS - IP', 'fullName' => 'NU PAGAMENTOS S.A. - INSTITUIÇÃO DE PAGAMENTO', 'ispb' => '18236120'],
            ['code' => '077', 'name' => 'BANCO INTER', 'fullName' => 'Banco Inter S.A.', 'ispb' => '00416968'],
            ['code' => '212', 'name' => 'BANCO ORIGINAL', 'fullName' => 'Banco Original S.A.', 'ispb' => '92894922'],
            ['code' => '336', 'name' => 'BCO C6 S.A.', 'fullName' => 'Banco C6 S.A.', 'ispb' => '31872495'],
            ['code' => '290', 'name' => 'PAGSEGURO INTERNET IP S.A.', 'fullName' => 'PAGSEGURO INTERNET INSTITUIÇÃO DE PAGAMENTO S.A.', 'ispb' => '08561701'],
            ['code' => '323', 'name' => 'MERCADO PAGO IP LTDA.', 'fullName' => 'MERCADO PAGO INSTITUIÇÃO DE PAGAMENTO LTDA.', 'ispb' => '10573521'],
            ['code' => '380', 'name' => 'PICPAY', 'fullName' => 'PICPAY INSTITUIçãO DE PAGAMENTO S.A.', 'ispb' => '22896431'],
        ]);
    }
}
