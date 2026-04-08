<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new event on Eventbrite.
 *
 * Accepts the full event creation payload including name, start/end times,
 * currency, timezone, and venue. Returns the created event object.
 */
class EventbriteCreateEvent implements Tool
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
        return 'eventbrite_create_event';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new event on Eventbrite. Provide event name, start/end times, currency, and optionally a venue ID or online event details.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The event title.'],
            'start_utc' => ['type' => 'string', 'required' => true, 'description' => 'Start time in UTC (ISO 8601, e.g. "2026-06-15T18:00:00Z").'],
            'end_utc' => ['type' => 'string', 'required' => true, 'description' => 'End time in UTC (ISO 8601, e.g. "2026-06-15T21:00:00Z").'],
            'currency' => ['type' => 'string', 'required' => true, 'description' => 'Three-letter currency code (e.g. "USD", "EUR", "GBP").'],
            'description' => ['type' => 'string', 'description' => 'HTML description of the event.'],
            'summary' => ['type' => 'string', 'description' => 'Short plaintext summary (max 140 characters) for search and social.'],
            'timezone' => ['type' => 'string', 'description' => 'Event timezone (e.g. "America/New_York", "Europe/London"). Defaults to UTC.'],
            'venue_id' => ['type' => 'string', 'description' => 'ID of an existing venue. Omit for online events.'],
            'online_event' => ['type' => 'boolean', 'description' => 'Set to true for a virtual/online event.'],
            'listed' => ['type' => 'boolean', 'description' => 'Whether the event is publicly listed (default: true).'],
            'capacity' => ['type' => 'integer', 'description' => 'Maximum number of attendees. Omit for unlimited.'],
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

            $eventData = [
                'event' => [
                    'name' => ['html' => $args['name']],
                    'start' => ['utc' => $args['start_utc']],
                    'end' => ['utc' => $args['end_utc']],
                    'currency' => $args['currency'],
                ],
            ];

            // Optional fields
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
            if (isset($args['capacity'])) {
                $eventData['event']['capacity'] = (int) $args['capacity'];
            }

            $result = $this->service->createEvent($eventData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
