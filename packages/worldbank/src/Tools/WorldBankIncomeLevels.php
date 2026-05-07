<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * List World Bank income-level aggregates.
 */
class WorldBankIncomeLevels implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_income_levels';
    }

    public function description(): string
    {
        return 'List World Bank income level codes such as HIC, UMC, LMC, and LIC.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List income levels.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->getIncomeLevels();

            return ToolResult::success([
                'income_levels' => array_map(static fn (array $level): array => [
                    'id' => $level['id'] ?? null,
                    'iso2code' => $level['iso2code'] ?? null,
                    'name' => $level['value'] ?? null,
                ], $result['data']),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
