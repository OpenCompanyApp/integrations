<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Shopify product by ID.
 */
class ShopifyGetProduct implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_get_product';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Shopify product by its ID.
        Returns the full product object including variants, images, and options.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify product ID.'],
        ];
    }

    /**
     * Get a product from Shopify by ID.
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
                return ToolResult::error('Product ID is required.');
            }

            $result = $this->service->getProduct($id);
            $product = $result['product'] ?? $result;

            return ToolResult::success($product);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
