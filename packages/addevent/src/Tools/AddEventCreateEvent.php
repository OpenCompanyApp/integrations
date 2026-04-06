<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new calendar event in AddEvent.
 *
 * Creates an event with a title, start and end dates. Optionally include
 * a location, description, and category ID to organize the event.
 */
class AddEventCreateEvent implements Tool
{
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_create_event';
    }

    public function description(): string
    {
        return 'Create a new calendar event in AddEvent. Requires a title, start date, and end date. Optionally add a location, description, and category.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Event title.'],
            'start_date' => ['type' => 'string', 'required' => true, 'description' => 'Event start date/time (e.g., "2026-04-10T09:00:00").'],
            'end_date' => ['type' => 'string', 'required' => true, 'description' => 'Event end date/time (e.g., "2026-04-10T10:00:00").'],
            'location' => ['type' => 'string', 'description' => 'Event location (e.g., "Conference Room A, 123 Main St").'],
            'description' => ['type' => 'string', 'description' => 'Event description with details about the event.'],
            'category_id' => ['type' => 'integer', 'description' => 'Category ID to assign the event to. Use addevent_list_categories to find available categories.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('Event title is required.');
            }
            if (empty($args['start_date'])) {
                return ToolResult::error('Event start date is required.');
            }
            if (empty($args['end_date'])) {
                return ToolResult::error('Event end date is required.');
            }

            $result = $this->service->createEvent(
                title: $args['title'],
                startDate: $args['start_date'],
                endDate: $args['end_date'],
                location: $args['location'] ?? null,
                description: $args['description'] ?? null,
                categoryId: isset($args['category_id']) ? (int) $args['category_id'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
