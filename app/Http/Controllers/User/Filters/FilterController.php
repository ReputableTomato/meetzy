<?php

namespace App\Http\Controllers\User\Filters;

use App\Facades\User\Country\CountryServiceFacade;
use App\Facades\User\Filters\FilterServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Filters\GetCountriesRequest;
use App\Http\Requests\User\Filters\GetGenderRequest;
use App\Http\Requests\User\Filters\GetSearchSettingsRequest;
use App\Http\Requests\User\Filters\GetSexesRequest;
use App\Http\Requests\User\Filters\UpdateFiltersRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FilterController extends Controller
{
    /**
     * @param UpdateFiltersRequest $request
     * @return JsonResponse
     */
    public function updateFilters(UpdateFiltersRequest $request): JsonResponse
    {
        return FilterServiceFacade::updateFilters($request);
    }

    /**
     * @param GetSearchSettingsRequest $request
     * @return JsonResponse
     */
    public function getSearchSettings(GetSearchSettingsRequest $request): JsonResponse
    {
        return FilterServiceFacade::getSearchSettings($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function getCountry(Request $request, $id): JsonResponse
    {
        return FilterServiceFacade::getCountry($id);
    }
}
