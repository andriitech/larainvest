<?php

namespace App\Adapters\Market;

use App\Adapters\Contracts\DataProviderInterface;
use App\Gateways\AlphaVantage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MarketDataAdapter implements DataProviderInterface
{
    private AlphaVantage $dataProvider;
    private string $cacheKey;

    /**
     * @param AlphaVantage $alphaVantage
     */
    public function __construct(AlphaVantage $alphaVantage)
    {
        $this->dataProvider = $alphaVantage;
        $this->cache = strtolower(class_basename($this->dataProvider));
    }

    /**
     * @return Collection
     */
    public function getAssets(): Collection
    {
        $cacheKey = "{$this->cache}_assets";

        $assets = Cache::remember($cacheKey, now()->addHour(), function () {
            return $this->dataProvider->getAllAssets();
        });

        return $assets;
    }

    /**
     * @param string $symbol
     * @param string $interval
     * @return mixed
     */
    public function getHistoricalData(string $symbol, string $interval): Collection
    {
        $cacheKey = "{$this->cache}_{$symbol}_{$interval}";

        $historicalData = Cache::remember($cacheKey, now()->addHour(), function () use ($symbol, $interval) {
            return $this->dataProvider->getHistoricalData($symbol, $interval);
        });

        return $historicalData;
    }
}
