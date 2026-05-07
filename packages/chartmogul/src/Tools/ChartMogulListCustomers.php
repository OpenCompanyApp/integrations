<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ChartMogul customers with cursor pagination and filters.
 */
class ChartMogulListCustomers implements Tool
{
    /**
     * @param  ChartMogulService  $service  The ChartMogul API client.
     */
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_list_customers';
    }

    public function description(): string
    {
        return 'List customers from ChartMogul. Supports cursor pagination and filters including status, email, data source UUID, external ID, and billing system.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a previous response. Use only when has_more is true.'],
            'status' => ['type' => 'string', 'description' => 'Filter by customer status. Common values: "Active", "Cancelled", "Future".'],
            'email' => ['type' => 'string', 'description' => 'Filter by customer email address.'],
            'data_source_uuid' => ['type' => 'string', 'description' => 'Filter by ChartMogul data source UUID.'],
            'external_id' => ['type' => 'string', 'description' => 'Filter by customer external ID.'],
            'system' => ['type' => 'string', 'description' => 'Filter by billing system name, e.g. Stripe or Custom.'],
        ];
    }

    /**
     * List customers through the ChartMogul API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (per_page, cursor, status, email, data_source_uuid, external_id, system).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $status = $args['status'] ?? null;
            $email = $args['email'] ?? null;

            $result = $this->service->listCustomers(
                $perPage,
                $args['cursor'] ?? null,
                $status,
                $email,
                $args['data_source_uuid'] ?? null,
                $args['external_id'] ?? null,
                $args['system'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
