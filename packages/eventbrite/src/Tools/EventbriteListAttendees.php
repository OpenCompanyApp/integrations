<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List attendees for an Eventbrite event.
 *
 * Returns a paginated list of attendees with profile information,
 * ticket class, order details, and check-in status.
 */
class EventbriteListAttendees implements Tool
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
        return 'eventbrite_list_attendees';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List attendees for an Eventbrite event. Returns paginated attendee profiles with name, email, ticket class, and check-in status.';
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
            'status' => ['type' => 'string', 'description' => 'Filter by attendance status: "attending", "not_attending", or "all" (default: "attending").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'continuation' => ['type' => 'string', 'description' => 'Continuation token from a previous response.'],
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

            $params = [];
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['continuation'])) {
                $params['continuation'] = $args['continuation'];
            }

            $result = $this->service->listAttendees($args['event_id'], $params);

            $attendees = $result['attendees'] ?? [];
            $pagination = $result['pagination'] ?? [];

            $summary = array_map(function (array $attendee): array {
                $profile = $attendee['profile'] ?? [];

                return [
                    'id' => $attendee['id'] ?? null,
                    'name' => trim(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? '')),
                    'email' => $profile['email'] ?? null,
                    'ticket_class_name' => $attendee['ticket_class_name'] ?? null,
                    'status' => $attendee['status'] ?? null,
                    'checked_in' => $attendee['checked_in'] ?? false,
                    'created' => $attendee['created'] ?? null,
                    'changed' => $attendee['changed'] ?? null,
                ];
            }, $attendees);

            return ToolResult::success([
                'attendees' => $summary,
                'pagination' => [
                    'has_more_items' => $pagination['has_more_items'] ?? false,
                    'page_number' => $pagination['page_number'] ?? 1,
                    'page_size' => $pagination['page_size'] ?? count($summary),
                    'continuation' => $pagination['continuation'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
