<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_list_orders
 *
 * Lists orders from the WooCommerce store with optional filtering
 * and pagination.
 */
class WooCommerceListOrders implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_list_orders';
    }

    public function description(): string
    {
        return 'List orders from the WooCommerce store. Supports filtering by status, customer, date, and pagination.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'per_page'     => ['type' => 'integer', 'description' => 'Number of orders per page (default: 10, max: 100).'],
            'page'         => ['type' => 'integer', 'description' => 'Current page number (1-based).'],
            'status'       => ['type' => 'string',  'description' => 'Filter by status: any, pending, processing, on-hold, completed, cancelled, refunded, failed, trash.'],
            'customer'     => ['type' => 'integer', 'description' => 'Filter by customer ID.'],
            'product'      => ['type' => 'integer', 'description' => 'Filter by product ID.'],
            'after'        => ['type' => 'string',  'description' => 'Limit response to orders after this date (ISO 8601).'],
            'before'       => ['type' => 'string',  'description' => 'Limit response to orders before this date (ISO 8601).'],
            'orderby'      => ['type' => 'string',  'description' => 'Sort by: date, id, include, title, slug.'],
            'order'        => ['type' => 'string',  'description' => 'Sort direction: asc or desc (default: desc).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $params = array_filter([
                'per_page' => $args['per_page'] ?? null,
                'page'     => $args['page'] ?? null,
                'status'   => $args['status'] ?? null,
                'customer' => $args['customer'] ?? null,
                'product'  => $args['product'] ?? null,
                'after'    => $args['after'] ?? null,
                'before'   => $args['before'] ?? null,
                'orderby'  => $args['orderby'] ?? null,
                'order'    => $args['order'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listOrders($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
