<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a single Eventbrite attendee.
 *
 * Returns the full attendee record including profile data,
 * answers to custom questions, ticket information, and barcode.
 */
class EventbriteGetAttendee implements Tool
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
        return 'eventbrite_get_attendee';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get full details for a single Eventbrite attendee by event and attendee ID. Includes profile, ticket info, custom answers, and barcode.';
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
            'attendee_id' => ['type' => 'string', 'required' => true, 'description' => 'The attendee ID.'],
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

            $result = $this->service->getAttendee($args['event_id'], $args['attendee_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
