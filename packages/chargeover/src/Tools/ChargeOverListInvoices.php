<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChargeOverListInvoices implements Tool
{
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_list_invoices';
    }

    public function description(): string
    {
        return 'List invoices from ChargeOver. Returns invoice details including amounts, dates, line items, and payment status. Supports pagination and status filtering.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of invoices to return per page (default: 10, max: 500).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based, default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by invoice status (e.g., "open", "paid", "overdue", "cancelled").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listInvoices($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
