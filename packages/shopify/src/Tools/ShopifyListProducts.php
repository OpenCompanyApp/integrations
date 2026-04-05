<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Shopify products with optional filters and pagination.
 */
class ShopifyListProducts implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_products';
    }

    public function description(): string
    {
        return <<<'MD'
        List Shopify products with optional filters.
        Supports filtering by status, product_type, vendor, and collection_id.
        Use limit to control page size (max 250) and page_info for cursor-based pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of products to return (max 250).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: active, draft, archived, or any.'],
            'product_type' => ['type' => 'string', 'description' => 'Filter by product type.'],
            'vendor' => ['type' => 'string', 'description' => 'Filter by vendor.'],
            'collection_id' => ['type' => 'string', 'description' => 'Filter by collection ID.'],
            'page_info' => ['type' => 'string', 'description' => 'Cursor for pagination (from previous response).'],
        ];
    }

    /**
     * List products from Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['product_type'])) {
                $params['product_type'] = $args['product_type'];
            }
            if (isset($args['vendor'])) {
                $params['vendor'] = $args['vendor'];
            }
            if (isset($args['collection_id'])) {
                $params['collection_id'] = $args['collection_id'];
            }
            if (isset($args['page_info'])) {
                $params['page_info'] = $args['page_info'];
            }

            $result = $this->service->listProducts($params);
            $products = $result['products'] ?? [];

            return ToolResult::success([
                'products' => $products,
                'count' => count($products),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
