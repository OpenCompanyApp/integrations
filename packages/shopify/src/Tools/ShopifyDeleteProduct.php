<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Shopify product by ID.
 */
class ShopifyDeleteProduct implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_delete_product';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a Shopify product by its ID.
        This action is permanent and cannot be undone.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify product ID to delete.'],
        ];
    }

    /**
     * Delete a product from Shopify.
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

            $this->service->deleteProduct($id);

            return ToolResult::success([
                'deleted' => true,
                'id' => $id,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
