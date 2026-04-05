<?php

namespace OpenCompany\Integrations\Odoo\Tools;

use OpenCompany\Integrations\Odoo\OdooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List sales orders from Odoo with pagination and optional filtering.
 *
 * Retrieves a paginated list of sales orders (sale.order) from the Odoo instance.
 * Supports filtering by status, customer, date range, and other fields.
 */
class OdooListSalesOrders implements Tool
{
    /**
     * @param  OdooService  $service  The Odoo service instance for making API calls.
     */
    public function __construct(
        private OdooService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'odoo_list_sales_orders';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List sales orders from Odoo with pagination. Filter by status, customer, or date range.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of orders per page (default: 20, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "draft", "sent", "sale", "done", or "cancel".'],
            'partner_id' => ['type' => 'integer', 'description' => 'Filter by customer (partner) ID.'],
            'date_from' => ['type' => 'string', 'description' => 'Filter orders from this date (ISO 8601, e.g., "2025-01-01").'],
            'date_to' => ['type' => 'string', 'description' => 'Filter orders up to this date (ISO 8601, e.g., "2025-12-31").'],
        ];
    }

    /**
     * Execute the tool — fetch a paginated list of sales orders from Odoo.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Odoo integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? min((int) $args['limit'], 100) : 20;

            $filters = [];
            foreach (['status', 'partner_id', 'date_from', 'date_to'] as $field) {
                if (isset($args[$field])) {
                    $filters[$field] = $args[$field];
                }
            }

            $result = $this->service->listSalesOrders($page, $limit, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
