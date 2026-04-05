<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Shopify order.
 */
class ShopifyUpdateOrder implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_update_order';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Shopify order.
        Supports updating tags, note, and financial_status.
        Only provided fields will be updated.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify order ID to update.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated list of tags.'],
            'note' => ['type' => 'string', 'description' => 'Note attached to the order.'],
            'financial_status' => ['type' => 'string', 'description' => 'Financial status: pending, paid, partially_paid, refunded, voided.'],
        ];
    }

    /**
     * Update an order in Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Order ID is required.');
            }

            $data = [];

            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['note'])) {
                $data['note'] = $args['note'];
            }
            if (isset($args['financial_status'])) {
                $data['financial_status'] = $args['financial_status'];
            }

            $result = $this->service->updateOrder($id, $data);
            $order = $result['order'] ?? $result;

            return ToolResult::success([
                'id' => $order['id'] ?? null,
                'name' => $order['name'] ?? '',
                'financial_status' => $order['financial_status'] ?? '',
                'tags' => $order['tags'] ?? '',
                'note' => $order['note'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
