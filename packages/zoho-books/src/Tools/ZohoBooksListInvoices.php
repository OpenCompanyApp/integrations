<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_list_invoices
 *
 * Lists invoices from Zoho Books with optional filtering by status,
 * customer, date range, and pagination.
 */
class ZohoBooksListInvoices implements Tool
{
    /**
     * @param  ZohoBooksService  $service  The Zoho Books API service instance.
     */
    public function __construct(
        private ZohoBooksService $service,
    ) {}

    /**
     * The tool identifier used by the AI agent runtime.
     */
    public function name(): string
    {
        return 'zohobooks_list_invoices';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List invoices from Zoho Books. Returns a paginated list of invoices with optional filters for status, customer, and date range.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by invoice status: draft, sent, overdue, paid, voided, unpaid.'],
            'customer_id' => ['type' => 'string', 'description' => 'Filter invoices by customer ID.'],
            'date_start' => ['type' => 'string', 'description' => 'Filter by start date (ISO 8601, e.g., "2025-01-01").'],
            'date_end' => ['type' => 'string', 'description' => 'Filter by end date (ISO 8601, e.g., "2025-12-31").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of invoices per page (default: 25, max: 200).'],
            'search_text' => ['type' => 'string', 'description' => 'Search invoices by invoice number or customer name.'],
        ];
    }

    /**
     * Execute the tool call — list invoices from Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
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
                $params['per_page'] = min((int) $args['per_page'], 200);
            }
            if (isset($args['search_text'])) {
                $params['search_text'] = $args['search_text'];
            }

            $result = $this->service->listInvoices($params);

            $invoices = $result['invoices'] ?? [];
            $pageContext = $result['page_context'] ?? [];

            return ToolResult::success([
                'invoices' => $invoices,
                'total' => $pageContext['total'] ?? count($invoices),
                'page' => $pageContext['page'] ?? 1,
                'per_page' => $pageContext['per_page'] ?? 25,
                'has_more' => $pageContext['has_more_page'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
