<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List fulfillments for a Shopify order.
 */
class ShopifyListFulfillments implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_fulfillments';
    }

    public function description(): string
    {
        return <<<'MD'
        List all fulfillments for a specific Shopify order.
        Returns tracking numbers, tracking URLs, shipment status, and line items for each fulfillment.
        MD;
    }

    public function parameters(): array
    {
        return [
            'order_id' => ['type' => 'string', 'description' => 'The Shopify order ID to list fulfillments for.'],
        ];
    }

    /**
     * List fulfillments for a Shopify order.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $orderId = $args['order_id'] ?? '';
            if (empty($orderId)) {
                return ToolResult::error('order_id is required.');
            }

            $result = $this->service->listFulfillments($orderId);
            $fulfillments = $result['fulfillments'] ?? [];

            return ToolResult::success([
                'fulfillments' => $fulfillments,
                'count' => count($fulfillments),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
