<?php

namespace App\SearchProviders;

use App\Dtos\MunicipalitySearchDto;
use App\SearchProviders\Contracts\SearchProviderInterface;
use GuzzleHttp\Psr7\Response;

class BrasilApiSearchProvider extends AbstractSearchProvider implements SearchProviderInterface
{
    protected string $provider = 'BrasilApi';

    public function handleResponse(Response $response): array
    {
        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        $list = [];
        foreach ($jsonResponse as $municipalities) {
            $list[] = (new MunicipalitySearchDto())
                ->setName($municipalities['nome'])
                ->setIbgeCode($municipalities['codigo_ibge']);
        }

        return $list;
    }
}
