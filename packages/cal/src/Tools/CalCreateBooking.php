<?php

namespace OpenCompany\Integrations\Cal\Tools;

use OpenCompany\Integrations\Cal\CalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new booking in Cal.com.
 *
 * Books a time slot for a given event type, specifying the time range
 * and attendee responses (name, email, and custom fields).
 *
 * @see https://developer.cal.com/api/endpoints/bookings
 */
class CalCreateBooking implements Tool
{
    public function __construct(
        private CalService $service,
    ) {}

    public function name(): string
    {
        return 'cal_create_booking';
    }

    public function description(): string
    {
        return 'Create a new booking in Cal.com for a specific event type. Provide the event type, start/end times, and attendee information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'eventTypeId' => ['type' => 'integer', 'required' => true, 'description' => 'The event type ID to book.'],
            'start' => ['type' => 'string', 'required' => true, 'description' => 'Start time in ISO 8601 format (e.g., "2026-04-10T09:00:00Z").'],
            'end' => ['type' => 'string', 'required' => true, 'description' => 'End time in ISO 8601 format (e.g., "2026-04-10T09:30:00Z").'],
            'responses' => ['type' => 'object', 'required' => true, 'description' => 'Attendee responses. Must include "name" and "email". Example: {"name": "John Doe", "email": "john@example.com", "notes": "Optional notes."}.'],
        ];
    }

    /**
     * Execute the tool — create a booking in Cal.com.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cal.com integration is not configured.');
            }

            if (!isset($args['eventTypeId'])) {
                return ToolResult::error('The "eventTypeId" parameter is required.');
            }

            if (!isset($args['start'])) {
                return ToolResult::error('The "start" parameter is required.');
            }

            if (!isset($args['end'])) {
                return ToolResult::error('The "end" parameter is required.');
            }

            if (!isset($args['responses']) || !is_array($args['responses'])) {
                return ToolResult::error('The "responses" parameter is required and must be an object with at least "name" and "email".');
            }

            $eventTypeId = (int) $args['eventTypeId'];
            $start = $args['start'];
            $end = $args['end'];
            $responses = $args['responses'];

            if (empty($responses['name']) || empty($responses['email'])) {
                return ToolResult::error('Responses must include at least "name" and "email".');
            }

            $result = $this->service->createBooking($eventTypeId, $start, $end, $responses);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
