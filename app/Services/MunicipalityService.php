<?php

namespace App\Services;

use App\SearchProviders\AbstractSearchProvider;
use Illuminate\Support\Facades\Cache;

class MunicipalityService
{
    const CONFIG_FILE = 'municipalitysearchproviders';

    /**
     * @var AbstractSearchProvider
     */
    private AbstractSearchProvider $searchProvider;

    public function __construct()
    {
        $this->setMunicipalitiesSearchProvider(config(self::CONFIG_FILE . ".default"));
    }

    /**
     * @param string $state
     * @return array
     */
    public function search(string $state): array
    {
        $cacheTime = (int)config(self::CONFIG_FILE . ".cacheExpirationSeconds");

        $response = Cache::remember("state-{$state}", $cacheTime, function () use ($state) {
            return $this->searchProvider->search($state);
        });

        if (array_key_exists('error', $response)) {
            Cache::forget("state-{$state}");
        }

        return $response;
    }

    /**
     * @param string $providerName
     * @return void
     */
    private function setMunicipalitiesSearchProvider(string $providerName): void
    {
        $this->searchProvider = app(config(self::CONFIG_FILE . ".providers.{$providerName}.class"));
    }
}
