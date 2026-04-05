<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Shopify orders with optional filters and pagination.
 */
class ShopifyListOrders implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_orders';
    }

    public function description(): string
    {
        return <<<'MD'
        List Shopify orders with optional filters.
        Supports filtering by status (open, closed, cancelled, any), financial_status, and fulfillment_status.
        Use limit to control page size (max 250) and page_info for cursor-based pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of orders to return (max 250).'],
            'status' => ['type' => 'string', 'description' => 'Filter by order status: open, closed, cancelled, any.'],
            'financial_status' => ['type' => 'string', 'description' => 'Filter by financial status: pending, paid, partially_paid, refunded, voided.'],
            'fulfillment_status' => ['type' => 'string', 'description' => 'Filter by fulfillment status: fulfilled, unfulfilled, partial, restocked.'],
            'page_info' => ['type' => 'string', 'description' => 'Cursor for pagination (from previous response).'],
        ];
    }

    /**
     * List orders from Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['financial_status'])) {
                $params['financial_status'] = $args['financial_status'];
            }
            if (isset($args['fulfillment_status'])) {
                $params['fulfillment_status'] = $args['fulfillment_status'];
            }
            if (isset($args['page_info'])) {
                $params['page_info'] = $args['page_info'];
            }

            $result = $this->service->listOrders($params);
            $orders = $result['orders'] ?? [];

            return ToolResult::success([
                'orders' => $orders,
                'count' => count($orders),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
