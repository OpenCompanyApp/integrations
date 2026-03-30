<?php

namespace OpenCompany\Integrations\WorldBank;

use Illuminate\Support\Facades\Http;

class WorldBankService
{
    private const BASE_URL = 'https://api.worldbank.org/v2';

    /** Common indicator codes for quick reference in tool descriptions. */
    public const COMMON_INDICATORS = [
        'NY.GDP.MKTP.CD' => 'GDP (current US$)',
        'NY.GDP.MKTP.KD.ZG' => 'GDP growth (annual %)',
        'NY.GDP.PCAP.CD' => 'GDP per capita (current US$)',
        'FP.CPI.TOTL.ZG' => 'Inflation, consumer prices (annual %)',
        'SL.UEM.TOTL.ZS' => 'Unemployment (% of labor force)',
        'SP.POP.TOTL' => 'Population, total',
        'SP.POP.GROW' => 'Population growth (annual %)',
        'SP.DYN.LE00.IN' => 'Life expectancy at birth (years)',
        'SI.POV.GINI' => 'Gini index',
        'EN.ATM.CO2E.PC' => 'CO2 emissions (metric tons per capita)',
        'SE.ADT.LITR.ZS' => 'Literacy rate, adult (% of 15+)',
        'GC.DOD.TOTL.GD.ZS' => 'Central government debt (% of GDP)',
        'BN.CAB.XOKA.GD.ZS' => 'Current account balance (% of GDP)',
        'NE.EXP.GNFS.ZS' => 'Exports (% of GDP)',
    ];

    /** @return array{meta: array, data: array} */
    public function getCountries(array $params = []): array
    {
        return $this->get('/country', array_merge(['per_page' => 300], $params));
    }

    /** @return array{meta: array, data: array} */
    public function getCountry(string $code): array
    {
        return $this->get("/country/{$code}");
    }

    /** @return array{meta: array, data: array} */
    public function getIndicators(array $params = []): array
    {
        return $this->get('/indicator', array_merge(['per_page' => 50], $params));
    }

    /** @return array{meta: array, data: array} */
    public function getIndicator(string $code): array
    {
        return $this->get("/indicator/{$code}");
    }

    /**
     * Search indicators by keyword within World Development Indicators (source 2).
     * Fetches all ~1500 WDI indicators and filters client-side since the API has no keyword search.
     *
     * @return array{meta: array, data: array}
     */
    public function searchIndicators(string $keyword): array
    {
        $result = $this->get('/indicator', [
            'source' => 2,
            'per_page' => 2000,
        ]);

        $keyword = mb_strtolower($keyword);
        $filtered = array_values(array_filter($result['data'] ?? [], function (array $ind) use ($keyword) {
            return str_contains(mb_strtolower($ind['name'] ?? ''), $keyword)
                || str_contains(mb_strtolower($ind['id'] ?? ''), $keyword)
                || str_contains(mb_strtolower($ind['sourceNote'] ?? ''), $keyword);
        }));

        return [
            'meta' => ['total' => count($filtered)],
            'data' => $filtered,
        ];
    }

    /** @return array{meta: array, data: array} */
    public function getTopics(): array
    {
        return $this->get('/topic');
    }

    /** @return array{meta: array, data: array} */
    public function getTopicIndicators(int $topicId): array
    {
        return $this->get("/topic/{$topicId}/indicator", ['per_page' => 50]);
    }

    /** @return array{meta: array, data: array} */
    public function getData(string $countries, string $indicator, array $params = []): array
    {
        return $this->get(
            "/country/{$countries}/indicator/{$indicator}",
            array_merge(['per_page' => 100], $params),
        );
    }

    /** @return array{meta: array, data: array} */
    private function get(string $endpoint, array $query = []): array
    {
        $query['format'] = 'json';

        $response = Http::timeout(15)
            ->get(self::BASE_URL . $endpoint, $query);

        if (! $response->successful()) {
            throw new \RuntimeException(
                "World Bank API error ({$response->status()}): {$response->body()}"
            );
        }

        $json = $response->json();

        // The World Bank API returns a two-element array: [paginationMeta, dataArray]
        // The search endpoint returns an object with different structure
        if (is_array($json) && isset($json[0]) && isset($json[0]['page'])) {
            return [
                'meta' => $json[0],
                'data' => $json[1] ?? [],
            ];
        }

        // Fallback — return as-is
        return [
            'meta' => [],
            'data' => is_array($json) ? $json : [],
        ];
    }
}
