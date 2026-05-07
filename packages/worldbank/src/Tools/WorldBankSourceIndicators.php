<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * List series available in a World Bank data source.
 */
class WorldBankSourceIndicators implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_source_indicators';
    }

    public function description(): string
    {
        return 'List indicator series available in a World Bank data source. Source 2 is World Development Indicators.';
    }

    public function parameters(): array
    {
        return [
            'source_id' => ['type' => 'string', 'required' => true, 'description' => 'World Bank source ID, such as 2 for World Development Indicators.'],
            'page' => ['type' => 'integer', 'description' => 'Optional page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Optional page size. Defaults to 100.'],
        ];
    }

    /**
     * List source indicators.
     *
     * @param  array<string, mixed>  $args  Tool arguments (source_id, page, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $sourceId = $args['source_id'] ?? null;
            if (! $sourceId) {
                return ToolResult::error('source_id is required.');
            }

            $result = $this->service->getSourceIndicators((string) $sourceId, array_filter([
                'page' => $args['page'] ?? null,
                'per_page' => isset($args['per_page']) ? min((int) $args['per_page'], 500) : null,
            ], static fn (mixed $value): bool => $value !== null && $value !== ''));

            return ToolResult::success([
                'source_id' => (string) $sourceId,
                'total' => $result['meta']['total'] ?? count($result['data']),
                'indicators' => array_map(static fn (array $indicator): array => [
                    'code' => $indicator['id'] ?? null,
                    'name' => $indicator['value'] ?? null,
                ], $result['data']),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
