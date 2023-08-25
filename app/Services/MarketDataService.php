<?php

namespace App\Services;

use App\Adapters\Contracts\DataProviderInterface;
use Illuminate\Support\Collection;

class MarketDataService
{
    private DataProviderInterface $dataProvider;

    /**
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @return Collection
     */
    public function getAssets(): Collection
    {
        $assets = $this->dataProvider->getAssets();

        return $assets;
    }

    public function getHistoricalData(string $symbol, string $interval = 'daily')
    {
        $historicalData = $this->dataProvider->getHistoricalData($symbol, $interval);

        return $historicalData;
    }
}
