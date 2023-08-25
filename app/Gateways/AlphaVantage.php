<?php

namespace App\Gateways;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use JsonException;
use Psr\Http\Message\ResponseInterface;

class AlphaVantage
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->host = config("services.alphavantage.host");
        $this->apiKey = config("services.alphavantage.key");
    }

    /**
     * @return Collection
     * @throws GuzzleException
     */
    public function getAllAssets(): Collection
    {
        $params = [
            'query' => [
                'function' => 'LISTING_STATUS',
                'apikey' => $this->apiKey,
            ]
        ];

        $response = $this->query(Request::METHOD_GET, 'query', $params);

        $assets = $this->parseGetAssetsResponse($response);

        return $assets;
    }


    /**
     * @param string $symbol
     * @param string $interval
     * @return Collection
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getHistoricalData(string $symbol, string $interval): Collection
    {
        $params = [
            'query' => [
                'function' => 'TIME_SERIES_' . strtoupper($interval),
                'symbol' => $symbol,
                'apikey' => $this->apiKey,
            ],
        ];

        $response = $this->query(Request::METHOD_GET, 'query', $params);

        $historicalData = $this->parseHistoricalDataResponse($response);

        return $historicalData;
    }


    /**
     * @param string $method
     * @param string $endpoint
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function query(string $method, string $endpoint, array $params = []): ResponseInterface
    {
        $fullPath = $this->buildEndpointUrl($endpoint);

        $response = $this->client->request($method, $fullPath, $params);

        return $response;
    }

    /**
     * @param string $endpoint
     * @return string
     */
    private function buildEndpointUrl(string $endpoint): string
    {
        return "{$this->host}/{$endpoint}";
    }

    /**
     * @see getAllAssets
     * @param Response $response
     * @return Collection
     */
    private function parseGetAssetsResponse(Response $response): Collection
    {
        $csv = $response->getBody()->getContents();

        $lines = explode("\n", $csv);
        $header = str_getcsv(array_shift($lines));

        $data = [];

        foreach ($lines as $line) {
            $fields = str_getcsv($line);

            if (count($fields) === count($header)) {
                $entry = array_combine($header, $fields);

                $data[] = [
                    'symbol' => $entry['symbol'],
                    'name' => $entry['name']
                ];
            }
        }

        return collect($data);
    }

    /**
     * @param Response $response
     * @return Collection
     * @throws JsonException
     */
    private function parseHistoricalDataResponse(Response $response): Collection
    {
        $json = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return collect($json);
    }
}
