<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List products from the BigCommerce catalog.
 *
 * Supports pagination, filtering, and including related data
 * (variants, images, custom fields, etc.).
 */
class BigCommerceListProducts implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_list_products';
    }

    public function description(): string
    {
        return 'List products from the BigCommerce catalog. Supports pagination, filtering by name or SKU, and including variants/images.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of products to return per page (default: 50, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'keyword' => ['type' => 'string', 'description' => 'Filter products by keyword (matches name or SKU).'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated related resources to include (e.g., "variants,images,custom_fields").'],
            'categories' => ['type' => 'string', 'description' => 'Comma-separated category IDs to filter by.'],
            'is_visible' => ['type' => 'boolean', 'description' => 'Filter by visibility (true for visible, false for hidden).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g., "name", "price", "date_created", "id").'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $params = [];
            $stringParams = ['keyword', 'include', 'categories', 'sort', 'direction'];
            $intParams = ['limit', 'page'];

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

            if (isset($args['is_visible'])) {
                $params['is_visible'] = $args['is_visible'] ? 'true' : 'false';
            }

            $result = $this->service->listProducts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
