<?php

namespace Tests\Unit\SearchProviders;

use App\Dtos\MunicipalitySearchDto;
use App\SearchProviders\AbstractSearchProvider;
use App\SearchProviders\BrasilApiSearchProvider;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

class BrasilApiSearchProviderTest extends TestCase
{
    const AVAILABLE_RESULTS = [
        ['nome' => 'Belo Horizonte', 'codigo_ibge' => '1234'],
        ['nome' => 'Rio de Janeiro', 'codigo_ibge' => '5678'],
        ['nome' => 'São Paulo', 'codigo_ibge' => '91011'],
    ];

    public function testHandleResponse(): void
    {
        $searchProvider = $this->getSearchProviderInstance();
        $resultSearch = $searchProvider->handleResponse($this->getMockedPayload());

        $this->assertIsArray($resultSearch);
        $this->assertCount(3, $resultSearch);

        $this->assertInstanceOf(MunicipalitySearchDto::class, $resultSearch[0]);
        $this->assertInstanceOf(MunicipalitySearchDto::class, $resultSearch[1]);
        $this->assertInstanceOf(MunicipalitySearchDto::class, $resultSearch[2]);

        foreach (self::AVAILABLE_RESULTS as $key => $result) {
            $this->assertEquals($result['nome'], $resultSearch[$key]->name);
            $this->assertEquals($result['codigo_ibge'], $resultSearch[$key]->ibgeCode);
        }
    }

    /**
     * @return AbstractSearchProvider
     */
    private function getSearchProviderInstance(): AbstractSearchProvider
    {
        return app(BrasilApiSearchProvider::class);
    }

    /**
     * @return GuzzleResponse
     */
    private function getMockedPayload(): GuzzleResponse
    {
        return new GuzzleResponse(Response::HTTP_OK, [], json_encode(self::AVAILABLE_RESULTS));
    }
}
