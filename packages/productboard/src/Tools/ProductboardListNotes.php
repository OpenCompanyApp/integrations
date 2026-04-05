<?php

namespace OpenCompany\Integrations\Productboard\Tools;

use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List notes (customer feedback) from Productboard.
 *
 * Returns a paginated list of notes. Notes represent customer feedback,
 * insights, and requests that can be linked to features. Use
 * cursor-based pagination to iterate through large result sets.
 */
class ProductboardListNotes implements Tool
{
    public function __construct(
        private ProductboardService $service,
    ) {}

    public function name(): string
    {
        return 'productboard_list_notes';
    }

    public function description(): string
    {
        return 'List notes (customer feedback) from Productboard. Returns note titles, content, authors, and linked features. Supports cursor-based pagination.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Number of notes per page (max 100, default 100).'],
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

            $result = $this->service->listNotes($pageSize, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
