<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new product in the Shopify store.
 *
 * Requires at minimum a title. Supports all product fields
 * including body_html, vendor, product_type, tags, and status.
 */
class ShopifyCreateProduct implements Tool
{
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_create_product';
    }

    public function description(): string
    {
        return 'Create a new product in the Shopify store. Requires a title. Supports description, vendor, product type, tags, and status.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Product title.'],
            'body_html' => ['type' => 'string', 'description' => 'Product description (HTML allowed).'],
            'vendor' => ['type' => 'string', 'description' => 'Product vendor.'],
            'product_type' => ['type' => 'string', 'description' => 'Product type (e.g., "Shirts", "Electronics").'],
            'status' => ['type' => 'string', 'description' => 'Product status: "active", "draft", or "archived".'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated tags (e.g., "cotton, summer").'],
            'published' => ['type' => 'boolean', 'description' => 'Whether the product is published (default: true).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $data = [
                'title' => $args['title'],
            ];

            $optionalFields = [
                'body_html', 'vendor', 'product_type', 'status', 'tags', 'published',
            ];

            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->createProduct($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
