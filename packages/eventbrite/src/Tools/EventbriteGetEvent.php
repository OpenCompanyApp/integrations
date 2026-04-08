<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get full details for a single Eventbrite event.
 *
 * Returns the complete event object including description, venue,
 * ticket classes, organizer info, and all configured settings.
 */
class EventbriteGetEvent implements Tool
{
    /**
     * Create a new tool instance.
     */
    public function __construct(
        private EventbriteService $service,
    ) {}

    /**
     * The tool name used for dispatch.
     */
    public function name(): string
    {
        return 'eventbrite_get_event';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get full details for a single Eventbrite event by ID. Returns description, venue, ticket classes, organizer, and all settings.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'The Eventbrite event ID.'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eventbrite integration is not configured. Provide a token and organization ID.');
            }

            $result = $this->service->getEvent($args['event_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
