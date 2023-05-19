<?php

namespace App\SearchProviders;

use App\Dtos\MunicipalitySearchDto;
use App\SearchProviders\Contracts\SearchProviderInterface;
use GuzzleHttp\Psr7\Response;

class IbgeSearchProvider extends AbstractSearchProvider implements SearchProviderInterface
{
    protected string $provider = 'Ibge';

    public function handleResponse(Response $response): array
    {
        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        $list = [];
        foreach ($jsonResponse as $municipalities) {
            $list[] = (new MunicipalitySearchDto())
                ->setName($municipalities['nome'])
                ->setIbgeCode($municipalities['id']);
        }

        return $list;
    }
}
