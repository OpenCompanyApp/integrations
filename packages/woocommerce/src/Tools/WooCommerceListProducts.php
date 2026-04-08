<?php

namespace OpenCompany\Integrations\Woocommerce\Tools;

use OpenCompany\Integrations\Woocommerce\WoocommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List products from the WooCommerce catalog.
 *
 * Supports pagination, filtering, and including related data.
 */
class WoocommerceListProducts implements Tool
{
    public function __construct(
        private WoocommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_list_products';
    }

    public function description(): string
    {
        return 'List products from the WooCommerce catalog. Supports pagination, filtering by name or SKU, and including variants/images.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of products to return per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'search' => ['type' => 'string', 'description' => 'Search products by name or description.'],
            'status' => ['type' => 'string', 'description' => 'Filter by product status: "publish", "draft", "pending", "private", or "trash".'],
            'category' => ['type' => 'string', 'description' => 'Filter by category ID.'],
            'sku' => ['type' => 'string', 'description' => 'Filter by SKU.'],
            'orderby' => ['type' => 'string', 'description' => 'Sort collection by field (e.g., "date", "id", "title", "slug", "price").'],
            'order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $params = [];
            $stringParams = ['search', 'status', 'category', 'sku', 'orderby', 'order'];
            $intParams = ['per_page', 'page'];

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
