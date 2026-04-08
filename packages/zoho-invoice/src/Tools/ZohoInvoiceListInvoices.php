<?php

namespace OpenCompany\Integrations\ZohoInvoice\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceService;

/**
 * List invoices from Zoho Invoice with optional filters.
 *
 * Supports filtering by status, customer ID, date range, and pagination.
 */
class ZohoInvoiceListInvoices implements Tool
{
    /**
     * @param  ZohoInvoiceService  $service  The Zoho Invoice API service instance
     */
    public function __construct(
        private ZohoInvoiceService $service,
    ) {}

    public function name(): string
    {
        return 'zohoinvoice_list_invoices';
    }

    public function description(): string
    {
        return 'List invoices from Zoho Invoice. Supports filtering by status (draft, sent, overdue, paid, void, partially_paid), customer, and date range.';
    }

    public function parameters(): array
    {
        return [
            'status' => [
                'type' => 'string',
                'description' => 'Filter by invoice status: draft, sent, overdue, paid, void, partially_paid.',
                'enum' => ['draft', 'sent', 'overdue', 'paid', 'void', 'partially_paid'],
            ],
            'customer_id' => [
                'type' => 'string',
                'description' => 'Filter invoices for a specific customer by their contact ID.',
            ],
            'date_start' => [
                'type' => 'string',
                'description' => 'Start date for filtering (ISO 8601, e.g., "2025-01-01").',
            ],
            'date_end' => [
                'type' => 'string',
                'description' => 'End date for filtering (ISO 8601, e.g., "2025-12-31").',
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default: 1).',
            ],
            'per_page' => [
                'type' => 'integer',
                'description' => 'Number of invoices per page (default: 25, max: 200).',
            ],
            'sort_column' => [
                'type' => 'string',
                'description' => 'Column to sort by: date, total, balance, created_time.',
            ],
            'sort_order' => [
                'type' => 'string',
                'description' => 'Sort direction: ascending or descending.',
                'enum' => ['ascending', 'descending'],
            ],
        ];
    }

    /**
     * Execute the list invoices tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Invoice integration is not configured.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['customer_id'])) {
                $params['customer_id'] = $args['customer_id'];
            }
            if (isset($args['date_start'])) {
                $params['date_start'] = $args['date_start'];
            }
            if (isset($args['date_end'])) {
                $params['date_end'] = $args['date_end'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['sort_column'])) {
                $params['sort_column'] = $args['sort_column'];
            }
            if (isset($args['sort_order'])) {
                $params['sort_order'] = $args['sort_order'];
            }

            $result = $this->service->listInvoices($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
