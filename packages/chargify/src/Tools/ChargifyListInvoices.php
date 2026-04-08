<?php

namespace OpenCompany\Integrations\Chargify\Tools;

use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List invoices from Chargify with optional status filtering and pagination.
 *
 * Returns an array of invoice objects including amounts, due dates, customer
 * details, and payment status.
 */
class ChargifyListInvoices implements Tool
{
    public function __construct(
        private ChargifyService $service,
    ) {}

    public function name(): string
    {
        return 'chargify_list_invoices';
    }

    public function description(): string
    {
        return 'List invoices from Chargify. Supports filtering by status (open, paid, pending, voided) and pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page, max 200 (default: 20).'],
            'status' => ['type' => 'string', 'description' => 'Filter by invoice status: open, paid, pending, voided.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargify integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;
            $status = $args['status'] ?? null;

            $result = $this->service->listInvoices($page, $perPage, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
