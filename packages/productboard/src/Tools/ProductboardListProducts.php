<?php

namespace OpenCompany\Integrations\Productboard\Tools;

use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List products from Productboard.
 *
 * Returns a paginated list of products. Products represent the top-level
 * containers in Productboard that hold features, components, and
 * releases. Use cursor-based pagination to iterate through results.
 */
class ProductboardListProducts implements Tool
{
    public function __construct(
        private ProductboardService $service,
    ) {}

    public function name(): string
    {
        return 'productboard_list_products';
    }

    public function description(): string
    {
        return 'List products from Productboard. Returns product names, descriptions, and IDs. Supports cursor-based pagination.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Number of products per page (max 100, default 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Productboard integration is not configured.');
            }

            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 100;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->listProducts($pageSize, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
