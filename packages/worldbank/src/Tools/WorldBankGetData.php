<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\Integrations\WorldBank\WorldBankService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch World Bank indicator observations.
 */
class WorldBankGetData implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(
        private WorldBankService $service,
    ) {}

    public function name(): string
    {
        return 'worldbank_get_data';
    }

    public function description(): string
    {
        return 'Fetch economic indicator data for one or more countries from the World Bank. Supports date ranges and most-recent-value mode. Use `worldbank_indicators` to find indicator codes and `worldbank_countries` to find ISO codes.';
    }

    public function parameters(): array
    {
        return [
            'indicator' => ['type' => 'string', 'required' => true, 'description' => 'World Bank indicator code (e.g. "NY.GDP.MKTP.CD", "SP.POP.TOTL"). Use worldbank_indicators to find codes.'],
            'countries' => ['type' => 'string', 'description' => 'Semicolon-separated ISO country codes (e.g. "US;CN;DE"). Use "all" for global data (default).'],
            'date_range' => ['type' => 'string', 'description' => 'Date range filter (e.g. "2020:2023", "2023", "2000:2023"). Omit to use mrnev (most recent value).'],
            'mrnev' => ['type' => 'string', 'description' => 'Number of most recent non-empty values to return per country (default: "1" when no dateRange).'],
            'per_page' => ['type' => 'string', 'description' => 'Number of results per page (default: "100", max: 500).'],
        ];
    }

    /**
     * Fetch indicator data for countries.
     *
     * @param  array<string, mixed>  $args  Tool arguments (indicator, countries, date_range, mrnev, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $indicator = $args['indicator'] ?? null;
            if (! $indicator) {
                return ToolResult::error('indicator is required (e.g. "NY.GDP.MKTP.CD"). Use worldbank_indicators to find indicator codes.');
            }

            $countries = $args['countries'] ?? 'all';

            $params = [];

            if ($args['date_range'] ?? null) {
                $params['date'] = $args['date_range'];
            }

            $mrnev = (int) ($args['mrnev'] ?? 0);
            if ($mrnev > 0) {
                $params['mrnev'] = $mrnev;
            }

            if ($args['per_page'] ?? null) {
                $params['per_page'] = min((int) $args['per_page'], 500);
            }

            $result = $this->service->getData($countries, $indicator, $params);
            $data = $result['data'] ?? [];
            $meta = $result['meta'] ?? [];

            // Filter out entries with null values
            $data = array_values(array_filter($data, fn (array $d) => $d['value'] !== null));

            $data = array_slice($data, 0, 100);

            $slim = array_map(fn (array $d) => [
                'country' => $d['country']['value'] ?? null,
                'country_code' => $d['countryiso3code'] ?? $d['country']['id'] ?? null,
                'indicator' => $d['indicator']['value'] ?? null,
                'indicator_code' => $d['indicator']['id'] ?? null,
                'date' => $d['date'] ?? null,
                'value' => $d['value'] ?? null,
                'unit' => $d['unit'] ?? null,
                'decimal' => $d['decimal'] ?? null,
            ], $data);

            return ToolResult::success([
                'indicator' => $indicator,
                'countries' => $countries,
                'total_records' => $meta['total'] ?? count($data),
                'showing' => count($slim),
                'data' => $slim,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
