<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AddEvent\AddEventService;

/**
 * Delete an AddEvent calendar event.
 *
 * Permanently removes an event by ID.
 */
class AddEventDeleteEvent implements Tool
{
    /**
     * @param  AddEventService  $service  The AddEvent API client.
     */
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_delete_event';
    }

    public function description(): string
    {
        return 'Delete an AddEvent event by ID. This action is permanent.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The AddEvent event ID.'],
        ];
    }

    /**
     * Delete an AddEvent event.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            return ToolResult::success($this->service->deleteEvent((string) $args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
