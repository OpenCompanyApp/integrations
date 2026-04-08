<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List orders from the Shopify store.
 *
 * Supports filtering by status, financial status,
 * fulfillment status, and pagination.
 */
class ShopifyListOrders implements Tool
{
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_orders';
    }

    public function description(): string
    {
        return 'List orders from the Shopify store. Supports filtering by status, financial status, fulfillment status, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of orders per page (default: 50, max: 250).'],
            'status' => ['type' => 'string', 'description' => 'Filter by order status: "open", "closed", "cancelled", or "any".'],
            'financial_status' => ['type' => 'string', 'description' => 'Filter by financial status: "pending", "paid", "partially_paid", "refunded", "voided".'],
            'fulfillment_status' => ['type' => 'string', 'description' => 'Filter by fulfillment status: "shipped", "partial", "unshipped", "any".'],
            'page_info' => ['type' => 'string', 'description' => 'Cursor for pagination (from a previous response).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $params = [];
            $stringParams = ['status', 'financial_status', 'fulfillment_status', 'page_info'];
            $intParams = ['limit'];

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
