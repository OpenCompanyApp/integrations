<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Shopify product.
 */
class ShopifyUpdateProduct implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_update_product';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Shopify product.
        Supports updating title, body_html (description), tags, and status.
        Only provided fields will be updated.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify product ID to update.'],
            'title' => ['type' => 'string', 'description' => 'New product title.'],
            'body_html' => ['type' => 'string', 'description' => 'New product description (HTML allowed).'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated list of tags.'],
            'status' => ['type' => 'string', 'description' => 'Product status: active, draft, or archived.'],
        ];
    }

    /**
     * Update a product in Shopify.
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

            $data = [];

            if (isset($args['title'])) {
                $data['title'] = $args['title'];
            }
            if (isset($args['body_html'])) {
                $data['body_html'] = $args['body_html'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }

            $result = $this->service->updateProduct($id, $data);
            $product = $result['product'] ?? $result;

            return ToolResult::success([
                'id' => $product['id'] ?? null,
                'title' => $product['title'] ?? '',
                'status' => $product['status'] ?? '',
                'handle' => $product['handle'] ?? '',
                'tags' => $product['tags'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
