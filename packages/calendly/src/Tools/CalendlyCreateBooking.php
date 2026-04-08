<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a booking in Calendly by creating a one-off event type.
 *
 * Since Calendly does not offer a direct "create booking" API endpoint,
 * this tool creates a one-off event type with a scheduling URL that
 * the invitee can use to finalize the booking.
 *
 * @see https://developer.calendly.com/api-docs/b3A6MzU2MzAy-create-one-off-event-type
 */
class CalendlyCreateBooking implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_create_booking';
    }

    public function description(): string
    {
        return 'Create a booking in Calendly by generating a one-off event type with a scheduling URL for the invitee.';
    }

    public function parameters(): array
    {
        return [
            'host' => ['type' => 'string', 'required' => true, 'description' => 'The host user URI (e.g. https://api.calendly.com/users/...).'],
            'start_time' => ['type' => 'string', 'required' => true, 'description' => 'Start time in ISO 8601 format (e.g. 2024-06-15T10:00:00Z).'],
            'end_time' => ['type' => 'string', 'required' => true, 'description' => 'End time in ISO 8601 format (e.g. 2024-06-15T11:00:00Z).'],
            'location' => ['type' => 'object', 'description' => 'Location object with "type" (e.g. "zoom", "google_conference", "custom") and optional "location".'],
            'name' => ['type' => 'string', 'description' => 'Name for the booking / event type.'],
        ];
    }

    /**
     * Create a one-off event type booking with the specified parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (host, start_time, end_time, location, name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $host = $args['host'] ?? '';
            if (empty($host)) {
                return ToolResult::error('host is required.');
            }

            $startTime = $args['start_time'] ?? '';
            if (empty($startTime)) {
                return ToolResult::error('start_time is required.');
            }

            $endTime = $args['end_time'] ?? '';
            if (empty($endTime)) {
                return ToolResult::error('end_time is required.');
            }

            $data = [
                'host' => $host,
                'date_range' => [
                    'start' => $startTime,
                    'end' => $endTime,
                ],
            ];

            if (isset($args['location']) && is_array($args['location'])) {
                $data['location'] = $args['location'];
            }
            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }

            $result = $this->service->createBooking($data);

            return ToolResult::success([
                'resource' => $result['resource'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
