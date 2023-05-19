<?php

namespace App\SearchProviders;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;

class AbstractSearchProvider
{

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    protected string $provider;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $state
     * @return array
     */
    public function search(string $state)
    {
        $response = [];

        try {
            $response['data'] = $this->handleResponse(
                $this->client->get(
                    sprintf(config("municipalitysearchproviders.providers.{$this->provider}.url"), $state)
                )
            );
        } catch (GuzzleException $exception) {
            Log::error($exception->getMessage());
            $response['error'] = __('messages.error.500');
        }

        return $response;
    }

    public function handleResponse(Response $response): array
    {
        //@TODO
    }
}
