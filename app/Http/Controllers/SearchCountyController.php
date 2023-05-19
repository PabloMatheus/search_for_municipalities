<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchMunicipalitiesRequest;
use App\Services\MunicipalityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SearchCountyController extends Controller
{

    /**
     * @var MunicipalityService
     */
    private MunicipalityService $countyService;

    /**
     * @param MunicipalityService $countyService
     */
    public function __construct(MunicipalityService $countyService)
    {
        $this->countyService = $countyService;
    }

    /**
     * @param SearchMunicipalitiesRequest $request
     * @return JsonResponse
     */
    public function searchMunicipalities(SearchMunicipalitiesRequest $request): JsonResponse
    {
        $response = $this->countyService->search($request->state);
        $statusCode = Response::HTTP_OK;

        if (array_key_exists('error', $response)) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $statusCode);
    }
}
