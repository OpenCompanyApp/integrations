<?php

namespace OpenCompany\Integrations\Woocommerce\Tools;

use OpenCompany\Integrations\Woocommerce\WoocommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List orders from the WooCommerce store.
 *
 * Supports filtering by status, date range, and pagination.
 */
class WoocommerceListOrders implements Tool
{
    public function __construct(
        private WoocommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_list_orders';
    }

    public function description(): string
    {
        return 'List orders from the WooCommerce store. Supports filtering by status, customer, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of orders per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by order status: "pending", "processing", "on-hold", "completed", "cancelled", "refunded", or "failed".'],
            'customer' => ['type' => 'integer', 'description' => 'Filter by customer ID.'],
            'after' => ['type' => 'string', 'description' => 'Limit response to orders created after this date (ISO 8601, e.g., "2025-01-01T00:00:00").'],
            'before' => ['type' => 'string', 'description' => 'Limit response to orders created before this date (ISO 8601).'],
            'orderby' => ['type' => 'string', 'description' => 'Sort collection by field (e.g., "date", "id", "total").'],
            'order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $params = [];
            $stringParams = ['status', 'after', 'before', 'orderby', 'order'];
            $intParams = ['per_page', 'page', 'customer'];

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
