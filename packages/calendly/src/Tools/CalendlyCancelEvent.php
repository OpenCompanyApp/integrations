<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a scheduled Calendly event.
 *
 * Cancels an active scheduled event with an optional reason.
 * The cancellation applies to all invitees.
 */
class CalendlyCancelEvent implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_cancel_event';
    }

    public function description(): string
    {
        return 'Cancel a scheduled Calendly event.';
    }

    public function parameters(): array
    {
        return [
            'uuid' => ['type' => 'string', 'required' => true, 'description' => 'The scheduled event UUID to cancel.'],
            'reason' => ['type' => 'string', 'description' => 'The reason for cancelling the event.'],
        ];
    }

    /**
     * Cancel a scheduled event by UUID with an optional reason.
     *
     * @param  array<string, mixed>  $args  Tool arguments (uuid, reason)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $uuid = $args['uuid'] ?? '';
            if (empty($uuid)) {
                return ToolResult::error('uuid is required.');
            }

            $reason = $args['reason'] ?? '';

            $result = $this->service->cancelEvent($uuid, $reason);

            return ToolResult::success([
                'resource' => $result['resource'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
