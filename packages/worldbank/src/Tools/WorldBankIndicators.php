<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\Integrations\WorldBank\WorldBankService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WorldBankIndicators implements Tool
{
    public function __construct(
        private WorldBankService $service,
    ) {}

    public function name(): string
    {
        return 'worldbank_indicators';
    }

    public function description(): string
    {
        $indicators = collect(WorldBankService::COMMON_INDICATORS)
            ->map(fn (string $desc, string $code) => "  - `{$code}` -- {$desc}")
            ->implode("\n");

        return <<<MD
        Search economic indicators by keyword. If no query is provided, returns common indicators. Use the indicator code with `worldbank_get_data` to fetch data.

        Common indicator codes:
        {$indicators}
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search keyword for indicators (e.g. "GDP", "inflation", "education"). If omitted, returns common indicators.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $query = $args['query'] ?? null;

            if (! $query) {
                // Return common indicators when no query
                $common = array_map(fn (string $desc, string $code) => [
                    'code' => $code,
                    'name' => $desc,
                ], WorldBankService::COMMON_INDICATORS, array_keys(WorldBankService::COMMON_INDICATORS));

                return ToolResult::success([
                    'hint' => 'No query provided. Showing common indicators. Search by keyword for specific indicators.',
                    'indicators' => array_values($common),
                ]);
            }

            $result = $this->service->searchIndicators($query);
            $indicators = $result['data'] ?? [];

            $slim = array_map(fn (array $ind) => [
                'code' => $ind['id'] ?? null,
                'name' => $ind['name'] ?? null,
                'source' => $ind['source']['value'] ?? null,
            ], array_slice($indicators, 0, 50));

            return ToolResult::success([
                'query' => $query,
                'total' => $result['meta']['total'] ?? count($slim),
                'showing' => count($slim),
                'indicators' => $slim,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
