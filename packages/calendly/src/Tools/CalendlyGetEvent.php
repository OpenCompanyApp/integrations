<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Calendly scheduled event by UUID.
 *
 * Retrieves full details of a scheduled event including start/end times,
 * location, event type, invitees counter, and cancellation info.
 */
class CalendlyGetEvent implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_get_event';
    }

    public function description(): string
    {
        return 'Get a single Calendly scheduled event by UUID.';
    }

    public function parameters(): array
    {
        return [
            'uuid' => ['type' => 'string', 'required' => true, 'description' => 'The scheduled event UUID.'],
        ];
    }

    /**
     * Get a single scheduled event by UUID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (uuid)
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

            $result = $this->service->getEvent($uuid);

            return ToolResult::success([
                'resource' => $result['resource'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
