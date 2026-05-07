<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AddEvent\AddEventService;

/**
 * Search AddEvent calendars.
 *
 * Returns paginated calendars from the Calendar and Events API v2.
 */
class AddEventListCalendars implements Tool
{
    /**
     * @param  AddEventService  $service  The AddEvent API client.
     */
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_list_calendars';
    }

    public function description(): string
    {
        return 'Search AddEvent calendars. Supports page, page_size, calendar_ids, sort_by, and sort_order.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of calendars per page (default: 10, max: 20).'],
            'calendar_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional calendar IDs to filter by.'],
            'sort_by' => ['type' => 'string', 'enum' => ['created', 'title'], 'description' => 'Sort field.'],
            'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort direction.'],
        ];
    }

    /**
     * Search AddEvent calendars.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            $calendarIds = $args['calendar_ids'] ?? [];
            if (! is_array($calendarIds)) {
                return ToolResult::error('calendar_ids must be an array when provided.');
            }

            return ToolResult::success($this->service->listCalendars(
                page: isset($args['page']) ? (int) $args['page'] : 1,
                pageSize: isset($args['page_size']) ? (int) $args['page_size'] : 10,
                calendarIds: array_map('strval', $calendarIds),
                sortBy: isset($args['sort_by']) ? (string) $args['sort_by'] : null,
                sortOrder: isset($args['sort_order']) ? (string) $args['sort_order'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
