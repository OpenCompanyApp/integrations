<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Shopify order by ID.
 */
class ShopifyGetOrder implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_get_order';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Shopify order by its ID.
        Returns the full order object including line items, customer, shipping, and fulfillment details.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify order ID.'],
        ];
    }

    /**
     * Get an order from Shopify by ID.
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

            $result = $this->service->getOrder($id);
            $order = $result['order'] ?? $result;

            return ToolResult::success($order);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
