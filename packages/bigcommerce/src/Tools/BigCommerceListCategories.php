<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List catalog categories from the BigCommerce store.
 *
 * Supports pagination and filtering by parent category.
 */
class BigCommerceListCategories implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_list_categories';
    }

    public function description(): string
    {
        return 'List catalog categories from the BigCommerce store. Supports filtering by parent category and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of categories per page (default: 50, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'parent_id' => ['type' => 'integer', 'description' => 'Filter by parent category ID. Use 0 for top-level categories.'],
            'name' => ['type' => 'string', 'description' => 'Filter by category name.'],
            'is_visible' => ['type' => 'boolean', 'description' => 'Filter by visibility.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g., "name", "id", "sort_order").'],
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
            $stringParams = ['name', 'sort', 'direction'];
            $intParams = ['limit', 'page', 'parent_id'];

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

            $result = $this->service->listCategories($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
