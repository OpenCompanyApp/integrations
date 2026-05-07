<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AddEvent\AddEventService;

/**
 * Update an AddEvent calendar event.
 *
 * Sends a PATCH request with only the provided event fields.
 */
class AddEventUpdateEvent implements Tool
{
    /**
     * @param  AddEventService  $service  The AddEvent API client.
     */
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_update_event';
    }

    public function description(): string
    {
        return 'Update an existing AddEvent event. Only fields provided in attributes are changed.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The AddEvent event ID.'],
            'attributes' => ['type' => 'object', 'required' => true, 'description' => 'Event fields to update, using AddEvent v2 field names.'],
        ];
    }

    /**
     * Update an AddEvent event.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            $attributes = $args['attributes'] ?? [];
            if (! is_array($attributes) || $attributes === []) {
                return ToolResult::error('attributes must be a non-empty object.');
            }

            return ToolResult::success($this->service->updateEvent((string) $args['id'], $attributes));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
