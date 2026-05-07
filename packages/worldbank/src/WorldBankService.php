<?php

namespace OpenCompany\Integrations\WorldBank;

use Illuminate\Support\Facades\Http;

/**
 * HTTP client for the World Bank Indicators API v2.
 *
 * Normalizes the API's pagination tuple responses into consistent meta/data arrays.
 */
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

    /**
     * @param  string  $baseUrl  Base URL for the World Bank API v2.
     */
    public function __construct(private string $baseUrl = self::BASE_URL)
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * List countries and aggregate economies.
     *
     * @param  array<string, mixed>  $params  Query parameters such as region, incomeLevel, lendingType, per_page, page.
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getCountries(array $params = []): array
    {
        return $this->get('/country', array_merge(['per_page' => 300], $params));
    }

    /**
     * Get one country or aggregate economy by code.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getCountry(string $code): array
    {
        return $this->get("/country/{$code}");
    }

    /**
     * List indicators.
     *
     * @param  array<string, mixed>  $params  Query parameters such as source, per_page, page.
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getIndicators(array $params = []): array
    {
        return $this->get('/indicator', array_merge(['per_page' => 50], $params));
    }

    /**
     * Get one indicator by code.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getIndicator(string $code): array
    {
        return $this->get("/indicator/{$code}");
    }

    /**
     * Search indicators by keyword within World Development Indicators (source 2).
     * Fetches all ~1500 WDI indicators and filters client-side since the API has no keyword search.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
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

    /**
     * List World Bank topics.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getTopics(): array
    {
        return $this->get('/topic');
    }

    /**
     * List indicators assigned to a topic.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getTopicIndicators(int $topicId): array
    {
        return $this->get("/topic/{$topicId}/indicator", ['per_page' => 50]);
    }

    /**
     * List World Bank data sources.
     *
     * @param  array<string, mixed>  $params  Query parameters such as per_page and page.
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getSources(array $params = []): array
    {
        return $this->get('/source', array_merge(['per_page' => 100], $params));
    }

    /**
     * List series/indicators available for a specific source.
     *
     * @param  string  $sourceId  World Bank source ID.
     * @param  array<string, mixed>  $params  Query parameters such as per_page and page.
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getSourceIndicators(string $sourceId, array $params = []): array
    {
        $result = $this->get('/sources/' . rawurlencode($sourceId) . '/series', array_merge(['per_page' => 100], $params));
        $source = $result['data'][0] ?? [];
        $variables = $source['concept'][0]['variable'] ?? [];

        return [
            'meta' => $result['meta'],
            'data' => is_array($variables) ? $variables : [],
        ];
    }

    /**
     * List aggregate regions.
     *
     * @param  array<string, mixed>  $params  Query parameters such as per_page and page.
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getRegions(array $params = []): array
    {
        return $this->get('/region', array_merge(['per_page' => 100], $params));
    }

    /**
     * List income levels.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getIncomeLevels(): array
    {
        return $this->get('/incomelevel', ['per_page' => 100]);
    }

    /**
     * List lending types.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getLendingTypes(): array
    {
        return $this->get('/lendingtype', ['per_page' => 100]);
    }

    /**
     * List languages supported by the World Bank API.
     *
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getLanguages(): array
    {
        return $this->get('/languages', ['per_page' => 100]);
    }

    /**
     * Get indicator observations for one or more countries.
     *
     * Supports semicolon-delimited country and indicator codes. Multiple indicators
     * require a source parameter, as documented by the World Bank V2 API.
     *
     * @param  array<string, mixed>  $params  Query parameters such as source, date, mrnev, footnote, per_page.
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    public function getData(string $countries, string $indicator, array $params = []): array
    {
        return $this->get(
            "/country/{$countries}/indicator/{$indicator}",
            array_merge(['per_page' => 100], $params),
        );
    }

    /**
     * Make a GET request to the World Bank API.
     *
     * @param  string  $endpoint  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array{meta: array<string, mixed>, data: array<int, array<string, mixed>>}
     */
    private function get(string $endpoint, array $query = []): array
    {
        $query['format'] = 'json';

        $response = Http::timeout(15)
            ->get($this->baseUrl . $endpoint, array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== ''));

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

        if (is_array($json) && isset($json['page'])) {
            $meta = array_intersect_key($json, array_flip(['page', 'pages', 'per_page', 'total', 'sourceid', 'lastupdated']));

            return [
                'meta' => $meta,
                'data' => isset($json['source']) && is_array($json['source']) ? $json['source'] : [],
            ];
        }

        return [
            'meta' => [],
            'data' => is_array($json) ? $json : [],
        ];
    }
}
