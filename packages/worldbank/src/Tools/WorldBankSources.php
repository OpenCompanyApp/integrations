<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * List World Bank data sources.
 */
class WorldBankSources implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_sources';
    }

    public function description(): string
    {
        return 'List World Bank data sources, including source IDs needed for source-specific and multi-indicator queries.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Optional page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Optional page size. Defaults to 100.'],
        ];
    }

    /**
     * List sources.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->getSources(array_filter([
                'page' => $args['page'] ?? null,
                'per_page' => isset($args['per_page']) ? min((int) $args['per_page'], 500) : null,
            ], static fn (mixed $value): bool => $value !== null && $value !== ''));

            return ToolResult::success([
                'total' => $result['meta']['total'] ?? count($result['data']),
                'sources' => array_map(static fn (array $source): array => [
                    'id' => $source['id'] ?? null,
                    'code' => $source['code'] ?? null,
                    'name' => $source['name'] ?? null,
                    'last_updated' => $source['lastupdated'] ?? null,
                    'data_available' => $source['dataavailability'] ?? null,
                    'metadata_available' => $source['metadataavailability'] ?? null,
                    'concepts' => $source['concepts'] ?? null,
                ], $result['data']),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
