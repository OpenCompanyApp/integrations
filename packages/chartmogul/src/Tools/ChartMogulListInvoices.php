<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ChartMogul invoices imported through the API.
 */
class ChartMogulListInvoices implements Tool
{
    /**
     * @param  ChartMogulService  $service  The ChartMogul API client.
     */
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_list_invoices';
    }

    public function description(): string
    {
        return 'List invoices from ChartMogul. Supports cursor pagination and filters by customer UUID or invoice external ID.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a previous response. Use only when has_more is true.'],
            'customer_uuid' => ['type' => 'string', 'description' => 'Filter invoices by customer UUID.'],
            'external_id' => ['type' => 'string', 'description' => 'Filter invoices by external ID.'],
        ];
    }

    /**
     * List invoices through the ChartMogul API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (per_page, cursor, customer_uuid, external_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $customerUuid = $args['customer_uuid'] ?? null;

            $result = $this->service->listInvoices($perPage, $args['cursor'] ?? null, $customerUuid, $args['external_id'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
