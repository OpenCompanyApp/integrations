<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List products from the Shopify store.
 *
 * Supports filtering by status, product type, vendor,
 * and pagination via limit and page_info parameters.
 */
class ShopifyListProducts implements Tool
{
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_products';
    }

    public function description(): string
    {
        return 'List products from the Shopify store. Supports filtering by status, product type, vendor, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of products to return per page (default: 50, max: 250).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "active", "draft", or "archived".'],
            'product_type' => ['type' => 'string', 'description' => 'Filter by product type.'],
            'vendor' => ['type' => 'string', 'description' => 'Filter by vendor name.'],
            'collection_id' => ['type' => 'string', 'description' => 'Filter by collection ID.'],
            'page_info' => ['type' => 'string', 'description' => 'Cursor for pagination (from a previous response).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $params = [];
            $stringParams = ['status', 'product_type', 'vendor', 'collection_id', 'page_info'];
            $intParams = ['limit'];

            foreach ($stringParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            foreach ($intParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = (int) $args[$key];
                }
            }

            $result = $this->service->listProducts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
