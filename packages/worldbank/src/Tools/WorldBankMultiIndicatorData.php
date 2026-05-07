<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * Fetch World Bank data for multiple indicators from one source.
 */
class WorldBankMultiIndicatorData implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_multi_indicator_data';
    }

    public function description(): string
    {
        return 'Fetch data for multiple semicolon-separated indicators from a single World Bank source. The V2 API allows up to 60 indicators.';
    }

    public function parameters(): array
    {
        return [
            'indicators' => ['type' => 'string', 'required' => true, 'description' => 'Semicolon-separated indicator codes, such as SI.POV.DDAY;SP.POP.TOTL.'],
            'countries' => ['type' => 'string', 'description' => 'Semicolon-separated country codes. Defaults to all.'],
            'source' => ['type' => 'string', 'description' => 'Source ID. Defaults to 2 for World Development Indicators.'],
            'date_range' => ['type' => 'string', 'description' => 'Date range such as 2000:2010.'],
            'footnote' => ['type' => 'boolean', 'description' => 'Include footnote detail when true.'],
            'per_page' => ['type' => 'integer', 'description' => 'Optional page size. Defaults to 100.'],
        ];
    }

    /**
     * Fetch multi-indicator data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (indicators, countries, source, date_range, footnote, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $indicators = $args['indicators'] ?? null;
            if (! $indicators) {
                return ToolResult::error('indicators is required.');
            }

            $indicatorCount = count(array_filter(explode(';', (string) $indicators)));
            if ($indicatorCount > 60) {
                return ToolResult::error('The World Bank V2 API supports at most 60 indicators in one multi-indicator query.');
            }

            $countries = (string) ($args['countries'] ?? 'all');
            $params = array_filter([
                'source' => $args['source'] ?? 2,
                'date' => $args['date_range'] ?? null,
                'footnote' => isset($args['footnote']) && $args['footnote'] ? 'y' : null,
                'per_page' => isset($args['per_page']) ? min((int) $args['per_page'], 500) : 100,
            ], static fn (mixed $value): bool => $value !== null && $value !== '');

            $result = $this->service->getData($countries, (string) $indicators, $params);
            $data = array_values(array_filter($result['data'], static fn (array $row): bool => ($row['value'] ?? null) !== null));

            return ToolResult::success([
                'indicators' => (string) $indicators,
                'countries' => $countries,
                'source' => (string) ($params['source'] ?? ''),
                'total_records' => $result['meta']['total'] ?? count($data),
                'showing' => count($data),
                'data' => array_map(static fn (array $row): array => [
                    'country' => $row['country']['value'] ?? null,
                    'country_code' => $row['countryiso3code'] ?? $row['country']['id'] ?? null,
                    'indicator' => $row['indicator']['value'] ?? null,
                    'indicator_code' => $row['indicator']['id'] ?? null,
                    'date' => $row['date'] ?? null,
                    'value' => $row['value'] ?? null,
                    'unit' => $row['unit'] ?? null,
                    'footnote' => $row['footnote'] ?? null,
                ], array_slice($data, 0, 100)),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
