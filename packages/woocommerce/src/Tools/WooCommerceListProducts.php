<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_list_products
 *
 * Lists products from the WooCommerce store with optional filtering
 * and pagination.
 */
class WooCommerceListProducts implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_list_products';
    }

    public function description(): string
    {
        return 'List products from the WooCommerce store. Supports filtering by status, category, search term, and pagination.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'per_page'    => ['type' => 'integer', 'description' => 'Number of products per page (default: 10, max: 100).'],
            'page'        => ['type' => 'integer', 'description' => 'Current page number (1-based).'],
            'search'      => ['type' => 'string',  'description' => 'Search term to filter products by name.'],
            'status'      => ['type' => 'string',  'description' => 'Filter by status: publish, draft, pending, private, trash.'],
            'category'    => ['type' => 'string',  'description' => 'Filter by category ID or slug.'],
            'orderby'     => ['type' => 'string',  'description' => 'Sort collection by: date, id, title, slug, price, popularity.'],
            'order'       => ['type' => 'string',  'description' => 'Sort direction: asc or desc (default: desc).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $params = array_filter([
                'per_page' => $args['per_page'] ?? null,
                'page'     => $args['page'] ?? null,
                'search'   => $args['search'] ?? null,
                'status'   => $args['status'] ?? null,
                'category' => $args['category'] ?? null,
                'orderby'  => $args['orderby'] ?? null,
                'order'    => $args['order'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listProducts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
