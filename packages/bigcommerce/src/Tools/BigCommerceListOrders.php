<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List orders from the BigCommerce store.
 *
 * Supports filtering by status, date range, and pagination.
 */
class BigCommerceListOrders implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_list_orders';
    }

    public function description(): string
    {
        return 'List orders from the BigCommerce store. Supports filtering by status, customer, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of orders per page (default: 50, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status_id' => ['type' => 'integer', 'description' => 'Filter by order status ID (0=Awaiting Fulfillment, 1=Awaiting Shipment, 2=Shipped, 3=Completed, 4=Cancelled, etc.).'],
            'customer_id' => ['type' => 'integer', 'description' => 'Filter by customer ID.'],
            'min_date_created' => ['type' => 'string', 'description' => 'Minimum date created (ISO 8601, e.g., "2025-01-01").'],
            'max_date_created' => ['type' => 'string', 'description' => 'Maximum date created (ISO 8601, e.g., "2025-12-31").'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g., "date_created", "total_inc_tax", "id").'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $params = [];
            $stringParams = ['min_date_created', 'max_date_created', 'sort', 'direction'];
            $intParams = ['limit', 'page', 'status_id', 'customer_id'];

            foreach ($stringParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            foreach ($intParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = (int) $args[$key];
                }
            }

            $result = $this->service->listOrders($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
