<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single order from the Shopify store by ID.
 */
class ShopifyGetOrder implements Tool
{
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_get_order';
    }

    public function description(): string
    {
        return 'Get a single order from the Shopify store by its ID. Returns full order details including line items and totals.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The order ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $result = $this->service->getOrder($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
