<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single invitee for a Calendly event.
 *
 * Retrieves a specific invitee's details including their name, email,
 * timezone, status, and any custom questions/answers.
 */
class CalendlyGetInvitee implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_get_invitee';
    }

    public function description(): string
    {
        return 'Get a single invitee for a Calendly event.';
    }

    public function parameters(): array
    {
        return [
            'event_uuid' => ['type' => 'string', 'required' => true, 'description' => 'The scheduled event UUID.'],
            'invitee_uuid' => ['type' => 'string', 'required' => true, 'description' => 'The invitee UUID.'],
        ];
    }

    /**
     * Get a single invitee by event UUID and invitee UUID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (event_uuid, invitee_uuid)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $eventUuid = $args['event_uuid'] ?? '';
            if (empty($eventUuid)) {
                return ToolResult::error('event_uuid is required.');
            }

            $inviteeUuid = $args['invitee_uuid'] ?? '';
            if (empty($inviteeUuid)) {
                return ToolResult::error('invitee_uuid is required.');
            }

            $result = $this->service->getInvitee($eventUuid, $inviteeUuid);

            return ToolResult::success([
                'resource' => $result['resource'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
