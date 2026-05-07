<?php

namespace OpenCompany\Integrations\MicrosoftOutlook\Tools;

use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: outlook_create_event
 *
 * Creates a new event on the signed-in user's default calendar via the Microsoft Graph API.
 */
class OutlookCreateEvent implements Tool
{
    /**
     * @param  OutlookService  $service  The Outlook API service instance.
     */
    public function __construct(
        private OutlookService $service,
    ) {}

    /**
     * Machine-name of the tool.
     */
    public function name(): string
    {
        return 'outlook_create_event';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new event on the default Outlook calendar. Specify subject, start/end time, body, and optionally attendees and location.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'subject' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The event subject / title.',
            ],
            'start' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'Start date and time in ISO 8601 format, e.g. "2025-06-15T09:00:00".',
            ],
            'end' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'End date and time in ISO 8601 format, e.g. "2025-06-15T10:00:00".',
            ],
            'time_zone' => [
                'type'        => 'string',
                'description' => 'IANA time zone for start/end, e.g. "Europe/Amsterdam". Defaults to "UTC".',
            ],
            'body' => [
                'type'        => 'string',
                'description' => 'The event body / description.',
            ],
            'body_type' => [
                'type'        => 'string',
                'description' => 'Body content type: "HTML" (default) or "Text".',
            ],
            'location' => [
                'type'        => 'string',
                'description' => 'The display name of the event location.',
            ],
            'attendees' => [
                'type'        => 'array',
                'description' => 'Array of attendee email addresses, e.g. ["alice@example.com", "bob@example.com"].',
            ],
            'is_all_day' => [
                'type'        => 'boolean',
                'description' => 'Whether this is an all-day event. Defaults to false.',
            ],
        ];
    }

    /**
     * Execute the tool: create a calendar event.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Outlook integration is not configured.');
            }

            foreach (['subject', 'start', 'end'] as $field) {
                if (empty($args[$field])) {
                    return ToolResult::error("{$field} is required.");
                }
            }

            $timeZone = $args['time_zone'] ?? 'UTC';
            $bodyType = $args['body_type'] ?? 'HTML';

            if (!in_array($bodyType, ['HTML', 'Text'], true)) {
                return ToolResult::error('body_type must be "HTML" or "Text".');
            }

            $payload = [
                'subject' => $args['subject'],
                'start'   => [
                    'dateTime' => $args['start'],
                    'timeZone' => $timeZone,
                ],
                'end' => [
                    'dateTime' => $args['end'],
                    'timeZone' => $timeZone,
                ],
            ];

            if (isset($args['body'])) {
                $payload['body'] = [
                    'contentType' => $bodyType,
                    'content'     => $args['body'],
                ];
            }

            if (isset($args['location'])) {
                $payload['location'] = [
                    'displayName' => $args['location'],
                ];
            }

            if (isset($args['attendees'])) {
                if (!is_array($args['attendees'])) {
                    return ToolResult::error('attendees must be an array of email addresses.');
                }

                /** @var array<int, string> $attendeeEmails */
                $attendeeEmails = $args['attendees'];
                $payload['attendees'] = array_map(fn (string $email) => [
                    'emailAddress' => ['address' => $email],
                    'type'         => 'required',
                ], $attendeeEmails);
            }

            if (isset($args['is_all_day'])) {
                $payload['isAllDay'] = (bool) $args['is_all_day'];
            }

            $event = $this->service->createEvent($payload);

            return ToolResult::success($event);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
