<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChartMogulListInvoices implements Tool
{
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_list_invoices';
    }

    public function description(): string
    {
        return 'List invoices from ChartMogul. Supports filtering by customer UUID and pagination. Returns invoice details including amount, dates, line items, and status.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'page' => ['type' => 'integer', 'description' => 'Page number, starting from 1 (default: 1).'],
            'customer_uuid' => ['type' => 'string', 'description' => 'Filter invoices by customer UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $customerUuid = $args['customer_uuid'] ?? null;

            $result = $this->service->listInvoices($perPage, $page, $customerUuid);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
