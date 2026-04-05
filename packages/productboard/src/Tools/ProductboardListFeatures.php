<?php

namespace OpenCompany\Integrations\Productboard\Tools;

use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List features from Productboard with optional pagination and filtering.
 *
 * Returns a paginated list of features. Use cursor-based pagination to
 * iterate through large result sets. Supports filtering by status,
 * product, or other criteria via query parameters.
 */
class ProductboardListFeatures implements Tool
{
    public function __construct(
        private ProductboardService $service,
    ) {}

    public function name(): string
    {
        return 'productboard_list_features';
    }

    public function description(): string
    {
        return 'List features from Productboard. Returns feature names, statuses, descriptions, and product assignments. Supports cursor-based pagination.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Number of features per page (max 100, default 100).'],
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

            $result = $this->service->listFeatures($pageSize, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
