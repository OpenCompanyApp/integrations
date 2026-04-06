<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List calendar events from AddEvent with optional pagination and category filtering.
 *
 * Returns a paginated list of events. Use the `limit` and `page` parameters to
 * control pagination. Filter events by category using the `category` parameter.
 */
class AddEventListEvents implements Tool
{
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_list_events';
    }

    public function description(): string
    {
        return 'List calendar events from AddEvent. Supports pagination with limit and page parameters, and optional filtering by category ID.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of events per page (default: 50, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed, default: 1).'],
            'category' => ['type' => 'integer', 'description' => 'Filter events by category ID. Use addevent_list_categories to find available categories.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $categoryId = isset($args['category']) ? (int) $args['category'] : null;

            $result = $this->service->listEvents($limit, $page, $categoryId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
