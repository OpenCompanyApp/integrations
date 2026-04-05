<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Shopify order.
 */
class ShopifyCreateOrder implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_create_order';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Shopify order.
        Supports line_items (array of variant_id + quantity), customer, financial_status, tags, and note.
        Returns the created order object with ID and order number.
        MD;
    }

    public function parameters(): array
    {
        return [
            'line_items' => ['type' => 'array', 'description' => 'Array of line items with variant_id and quantity.'],
            'customer' => ['type' => 'object', 'description' => 'Customer object with id or email.'],
            'financial_status' => ['type' => 'string', 'description' => 'Financial status: pending, paid, partially_paid, refunded, etc.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated list of tags.'],
            'note' => ['type' => 'string', 'description' => 'Optional note attached to the order.'],
        ];
    }

    /**
     * Create a new order in Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $data = [];

            if (isset($args['line_items']) && is_array($args['line_items'])) {
                $data['line_items'] = $args['line_items'];
            }
            if (isset($args['customer']) && is_array($args['customer'])) {
                $data['customer'] = $args['customer'];
            }
            if (isset($args['financial_status'])) {
                $data['financial_status'] = $args['financial_status'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['note'])) {
                $data['note'] = $args['note'];
            }

            $result = $this->service->createOrder($data);
            $order = $result['order'] ?? $result;

            return ToolResult::success([
                'id' => $order['id'] ?? null,
                'order_number' => $order['order_number'] ?? null,
                'name' => $order['name'] ?? '',
                'financial_status' => $order['financial_status'] ?? '',
                'total_price' => $order['total_price'] ?? '',
                'currency' => $order['currency'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
