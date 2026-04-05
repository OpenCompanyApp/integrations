<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Shopify product.
 *
 * Supports title, body_html, vendor, product_type, tags, status, and variants.
 */
class ShopifyCreateProduct implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_create_product';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Shopify product.
        Supports title, body_html (description), vendor, product_type, tags, status (draft/active/archived), and variants.
        Returns the created product object with ID and variants.
        MD;
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'description' => 'Product title.'],
            'body_html' => ['type' => 'string', 'description' => 'Product description (HTML allowed).'],
            'vendor' => ['type' => 'string', 'description' => 'Product vendor or brand.'],
            'product_type' => ['type' => 'string', 'description' => 'Product type (e.g. "Shoes", "Electronics").'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated list of tags.'],
            'status' => ['type' => 'string', 'description' => 'Product status: active, draft, or archived.'],
            'variants' => ['type' => 'array', 'description' => 'Array of variant objects with price, sku, option values, etc.'],
        ];
    }

    /**
     * Create a new product in Shopify.
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

            if (isset($args['title'])) {
                $data['title'] = $args['title'];
            }
            if (isset($args['body_html'])) {
                $data['body_html'] = $args['body_html'];
            }
            if (isset($args['vendor'])) {
                $data['vendor'] = $args['vendor'];
            }
            if (isset($args['product_type'])) {
                $data['product_type'] = $args['product_type'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['variants']) && is_array($args['variants'])) {
                $data['variants'] = $args['variants'];
            }

            $result = $this->service->createProduct($data);
            $product = $result['product'] ?? $result;

            return ToolResult::success([
                'id' => $product['id'] ?? null,
                'title' => $product['title'] ?? '',
                'status' => $product['status'] ?? '',
                'handle' => $product['handle'] ?? '',
                'product_type' => $product['product_type'] ?? '',
                'variants' => $product['variants'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
