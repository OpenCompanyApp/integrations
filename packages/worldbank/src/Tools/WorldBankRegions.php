<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * List World Bank regions and aggregates.
 */
class WorldBankRegions implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_regions';
    }

    public function description(): string
    {
        return 'List World Bank aggregate regions and region codes used for filtering country and aggregate data.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Optional page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Optional page size. Defaults to 100.'],
        ];
    }

    /**
     * List regions.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->getRegions(array_filter([
                'page' => $args['page'] ?? null,
                'per_page' => isset($args['per_page']) ? min((int) $args['per_page'], 500) : null,
            ], static fn (mixed $value): bool => $value !== null && $value !== ''));

            return ToolResult::success([
                'total' => $result['meta']['total'] ?? count($result['data']),
                'regions' => array_map(static fn (array $region): array => [
                    'id' => $region['id'] ?? null,
                    'code' => $region['code'] ?? null,
                    'iso2code' => $region['iso2code'] ?? null,
                    'name' => $region['name'] ?? null,
                ], $result['data']),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
