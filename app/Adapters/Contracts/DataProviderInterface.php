<?php

namespace App\Adapters\Contracts;

use Illuminate\Support\Collection;

interface DataProviderInterface
{
    public function getAssets(): Collection;

    public function getHistoricalData(string $symbol, string $interval);
}
