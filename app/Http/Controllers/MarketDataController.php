<?php

namespace App\Http\Controllers;

use App\Services\MarketDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketDataController extends Controller
{
    private MarketDataService $marketService;

    /**
     * @param MarketDataService $marketDataService
     */
    public function __construct(MarketDataService $marketDataService)
    {
        $this->marketService = $marketDataService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAssets(Request $request):JsonResponse
    {
        $assets = $this->marketService->getAssets();

        return response()->json([
            'assets' => $assets,
        ]);
    }

    public function getHistoricalData(string $symbol)
    {
        $data = $this->marketService->getHistoricalData($symbol);

        return response()->json([
            'historical' => $data
        ]);
    }
}
