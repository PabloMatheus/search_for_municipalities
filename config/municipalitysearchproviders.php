<?php

use App\SearchProviders\BrasilApiSearchProvider;
use App\SearchProviders\IbgeSearchProvider;

return [

    'default' => env('DEFAULT_MUNICIPALITIES_SEARCH_PROVIDER', 'BrasilApi'),
    'cacheExpirationSeconds' => env('DEFAULT_CACHE_EXPIRATION_SECONDS', 30),
    'providers' => [
        'BrasilApi' => [
            'url' => 'https://brasilapi.com.br/api/ibge/municipios/v1/%s',
            'class' => BrasilApiSearchProvider::class
        ],
        'Ibge' => [
            'url' => 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/%s/municipios',
            'class' => IbgeSearchProvider::class
        ],
    ]
];
