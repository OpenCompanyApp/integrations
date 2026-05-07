<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ChartMogul plans with cursor pagination.
 */
class ChartMogulListPlans implements Tool
{
    /**
     * @param  ChartMogulService  $service  The ChartMogul API client.
     */
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_list_plans';
    }

    public function description(): string
    {
        return 'List billing plans from ChartMogul. Supports cursor pagination and optional filtering by data source UUID.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a previous response. Use only when has_more is true.'],
            'data_source_uuid' => ['type' => 'string', 'description' => 'Filter by ChartMogul data source UUID.'],
        ];
    }

    /**
     * List plans through the ChartMogul API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (per_page, cursor, data_source_uuid).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;

            $result = $this->service->listPlans($perPage, $args['cursor'] ?? null, $args['data_source_uuid'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
