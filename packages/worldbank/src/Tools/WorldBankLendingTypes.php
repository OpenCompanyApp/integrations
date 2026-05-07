<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * List World Bank lending-type aggregates.
 */
class WorldBankLendingTypes implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_lending_types';
    }

    public function description(): string
    {
        return 'List World Bank lending type codes such as IBD, IDX, IDB, and LNX.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List lending types.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->getLendingTypes();

            return ToolResult::success([
                'lending_types' => array_map(static fn (array $type): array => [
                    'id' => $type['id'] ?? null,
                    'iso2code' => $type['iso2code'] ?? null,
                    'name' => $type['value'] ?? null,
                ], $result['data']),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
