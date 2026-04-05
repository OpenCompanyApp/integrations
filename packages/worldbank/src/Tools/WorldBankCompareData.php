<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\Integrations\WorldBank\WorldBankService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WorldBankCompareData implements Tool
{
    public function __construct(
        private WorldBankService $service,
    ) {}

    public function name(): string
    {
        return 'worldbank_compare_data';
    }

    public function description(): string
    {
        return 'Compare a single economic indicator across multiple countries. Returns the most recent value for each country side-by-side. Use `worldbank_indicators` to find indicator codes.';
    }

    public function parameters(): array
    {
        return [
            'indicator' => ['type' => 'string', 'required' => true, 'description' => 'World Bank indicator code (e.g. "NY.GDP.MKTP.CD", "SP.POP.TOTL"). Use worldbank_indicators to find codes.'],
            'countries' => ['type' => 'string', 'required' => true, 'description' => 'Semicolon-separated ISO country codes (e.g. "US;CN;DE;JP").'],
            'date_range' => ['type' => 'string', 'description' => 'Date range filter (e.g. "2020:2023"). Omit to get most recent value per country.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $indicator = $args['indicator'] ?? null;
            if (! $indicator) {
                return ToolResult::error('indicator is required (e.g. "NY.GDP.MKTP.CD"). Use worldbank_indicators to find indicator codes.');
            }

            $countries = $args['countries'] ?? null;
            if (! $countries) {
                return ToolResult::error('countries is required — semicolon-separated ISO codes (e.g. "US;CN;DE;JP").');
            }

            $params = ['mrnev' => 1];

            if ($args['date_range'] ?? null) {
                $params['date'] = $args['date_range'];
                unset($params['mrnev']);
            }

            $result = $this->service->getData($countries, $indicator, $params);
            $data = $result['data'] ?? [];

            // Filter null values and group by country
            $data = array_filter($data, fn (array $d) => $d['value'] !== null);

            $grouped = [];
            $indicatorName = null;
            foreach ($data as $d) {
                $code = $d['countryiso3code'] ?? $d['country']['id'] ?? 'unknown';
                $indicatorName ??= $d['indicator']['value'] ?? null;

                if (! isset($grouped[$code])) {
                    $grouped[$code] = [
                        'country' => $d['country']['value'] ?? null,
                        'country_code' => $code,
                        'values' => [],
                    ];
                }

                $grouped[$code]['values'][] = [
                    'date' => $d['date'] ?? null,
                    'value' => $d['value'] ?? null,
                ];
            }

            // Sort values by date descending within each country
            foreach ($grouped as &$entry) {
                usort($entry['values'], fn ($a, $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));
            }
            unset($entry);

            return ToolResult::success([
                'indicator' => $indicator,
                'indicator_name' => $indicatorName,
                'comparison' => array_values($grouped),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
