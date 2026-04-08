<?php

namespace OpenCompany\Integrations\ZohoBills\Tools;

use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoBillsListInvoices implements Tool
{
    public function __construct(
        private ZohoBillsService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_bills_list_invoices';
    }

    public function description(): string
    {
        return 'List invoices from Zoho Bills. Optionally filter by status (draft, sent, overdue, paid, voided, partially_paid) or customer ID.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of invoices per page (default: 25, max: 200).'],
            'status' => ['type' => 'string', 'description' => 'Filter by invoice status: draft, sent, overdue, paid, voided, partially_paid.'],
            'customer_id' => ['type' => 'string', 'description' => 'Filter invoices by customer ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Bills integration is not configured.');
            }

            $result = $this->service->listInvoices(
                page: (int) ($args['page'] ?? 1),
                perPage: (int) ($args['per_page'] ?? 25),
                status: $args['status'] ?? null,
                customerId: $args['customer_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
