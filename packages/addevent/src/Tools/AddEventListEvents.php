<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search AddEvent calendar events.
 *
 * Returns a paginated search result from the Calendar and Events API v2.
 */
class AddEventListEvents implements Tool
{
    /**
     * @param  AddEventService  $service  The AddEvent API client.
     */
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_list_events';
    }

    public function description(): string
    {
        return 'Search calendar events from AddEvent. Supports page, page_size, calendar_id, sort_by, and sort_order parameters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of events per page (default: 10, max: 20).'],
            'calendar_id' => ['type' => 'string', 'description' => 'Filter events by calendar ID.'],
            'sort_by' => ['type' => 'string', 'description' => 'Sort field supported by AddEvent.'],
            'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort direction.'],
        ];
    }

    /**
     * Search AddEvent events.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 10;

            $result = $this->service->listEvents(
                page: $page,
                pageSize: $pageSize,
                calendarId: isset($args['calendar_id']) ? (string) $args['calendar_id'] : null,
                sortBy: isset($args['sort_by']) ? (string) $args['sort_by'] : null,
                sortOrder: isset($args['sort_order']) ? (string) $args['sort_order'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
