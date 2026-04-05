<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing event on Eventbrite.
 *
 * Accepts partial updates — only the fields provided will be changed.
 * Returns the updated event object.
 */
class EventbriteUpdateEvent implements Tool
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
        return 'eventbrite_update_event';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Update an existing Eventbrite event. Only the fields you provide will be changed. Use to change title, times, description, venue, or status.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'The Eventbrite event ID to update.'],
            'name' => ['type' => 'string', 'description' => 'New event title.'],
            'start_utc' => ['type' => 'string', 'description' => 'New start time in UTC (ISO 8601).'],
            'end_utc' => ['type' => 'string', 'description' => 'New end time in UTC (ISO 8601).'],
            'description' => ['type' => 'string', 'description' => 'New HTML description.'],
            'summary' => ['type' => 'string', 'description' => 'New short summary (max 140 characters).'],
            'timezone' => ['type' => 'string', 'description' => 'New timezone (e.g. "America/New_York").'],
            'venue_id' => ['type' => 'string', 'description' => 'New venue ID.'],
            'online_event' => ['type' => 'boolean', 'description' => 'Set to true for online, false for in-person.'],
            'listed' => ['type' => 'boolean', 'description' => 'Whether the event is publicly listed.'],
            'status' => ['type' => 'string', 'description' => 'Change event status: "live" to publish, "draft" to unpublish.'],
            'capacity' => ['type' => 'integer', 'description' => 'New maximum number of attendees.'],
            'currency' => ['type' => 'string', 'description' => 'New three-letter currency code.'],
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

            $eventId = $args['event_id'];
            $eventData = ['event' => []];

            if (isset($args['name'])) {
                $eventData['event']['name'] = ['html' => $args['name']];
            }
            if (isset($args['start_utc'])) {
                $eventData['event']['start']['utc'] = $args['start_utc'];
            }
            if (isset($args['end_utc'])) {
                $eventData['event']['end']['utc'] = $args['end_utc'];
            }
            if (isset($args['description'])) {
                $eventData['event']['description'] = ['html' => $args['description']];
            }
            if (isset($args['summary'])) {
                $eventData['event']['summary'] = $args['summary'];
            }
            if (isset($args['timezone'])) {
                $eventData['event']['start']['timezone'] = $args['timezone'];
                $eventData['event']['end']['timezone'] = $args['timezone'];
            }
            if (isset($args['venue_id'])) {
                $eventData['event']['venue_id'] = $args['venue_id'];
            }
            if (isset($args['online_event'])) {
                $eventData['event']['online_event'] = $args['online_event'];
            }
            if (isset($args['listed'])) {
                $eventData['event']['listed'] = $args['listed'];
            }
            if (isset($args['status'])) {
                $eventData['event']['status'] = $args['status'];
            }
            if (isset($args['capacity'])) {
                $eventData['event']['capacity'] = (int) $args['capacity'];
            }
            if (isset($args['currency'])) {
                $eventData['event']['currency'] = $args['currency'];
            }

            $result = $this->service->updateEvent($eventId, $eventData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
