<?php

namespace OpenCompany\Integrations\Productboard\Tools;

use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List companies from Productboard.
 *
 * Returns a paginated list of companies. Companies represent customer
 * organizations that can be linked to notes and features. Use
 * cursor-based pagination to iterate through large result sets.
 */
class ProductboardListCompanies implements Tool
{
    public function __construct(
        private ProductboardService $service,
    ) {}

    public function name(): string
    {
        return 'productboard_list_companies';
    }

    public function description(): string
    {
        return 'List companies from Productboard. Returns company names, domains, and IDs. Supports cursor-based pagination.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Number of companies per page (max 100, default 100).'],
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

            $result = $this->service->listCompanies($pageSize, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
