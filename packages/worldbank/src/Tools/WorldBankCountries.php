<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\Integrations\WorldBank\WorldBankService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WorldBankCountries implements Tool
{
    public function __construct(
        private WorldBankService $service,
    ) {}

    public function name(): string
    {
        return 'worldbank_countries';
    }

    public function description(): string
    {
        return 'List or search countries from the World Bank. Optional query filters by name. Filter by region (EAS, ECS, LCN, MEA, NAC, SAS, SSF) or income level (HIC, UMC, LMC, LIC).';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query — country name or ISO code to filter results.'],
            'region' => ['type' => 'string', 'description' => 'Filter by region code: EAS (East Asia), ECS (Europe & Central Asia), LCN (Latin America), MEA (Middle East), NAC (North America), SAS (South Asia), SSF (Sub-Saharan Africa).'],
            'income_level' => ['type' => 'string', 'description' => 'Filter by income level: HIC (High), UMC (Upper Middle), LMC (Lower Middle), LIC (Low).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $params = [];

            if ($args['region'] ?? null) {
                $params['region'] = $args['region'];
            }

            if ($args['income_level'] ?? null) {
                $params['incomeLevel'] = $args['income_level'];
            }

            $result = $this->service->getCountries($params);
            $countries = $result['data'] ?? [];

            // Filter out aggregates (regions) — only keep actual countries
            $countries = array_values(array_filter($countries, function (array $c) {
                return ($c['region']['id'] ?? '') !== '' && ($c['region']['id'] ?? 'NA') !== 'NA';
            }));

            // Filter by name if query provided
            $query = $args['query'] ?? null;
            if ($query) {
                $query = mb_strtolower($query);
                $countries = array_values(array_filter($countries, function (array $c) use ($query) {
                    return str_contains(mb_strtolower($c['name'] ?? ''), $query)
                        || str_contains(mb_strtolower($c['iso2Code'] ?? ''), $query)
                        || str_contains(mb_strtolower($c['id'] ?? ''), $query);
                }));
            }

            $slim = array_map(fn (array $c) => [
                'id' => $c['id'] ?? null,
                'iso2Code' => $c['iso2Code'] ?? null,
                'name' => $c['name'] ?? null,
                'region' => $c['region']['value'] ?? null,
                'incomeLevel' => $c['incomeLevel']['value'] ?? null,
                'capitalCity' => $c['capitalCity'] ?? null,
            ], array_slice($countries, 0, 50));

            return ToolResult::success([
                'total' => count($countries),
                'showing' => count($slim),
                'countries' => $slim,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
