<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeListEvents — List events from Amplitude.
 *
 * Supports optional filtering by user_id, device_id, start/end timestamps,
 * and result limiting. Calls GET /api/2/events.
 */
class AmplitudeListEvents implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_list_events';
    }

    public function description(): string
    {
        return 'List events from Amplitude Analytics. Optionally filter by user ID, device ID, or time range. Returns the most recent events matching the criteria.';
    }

    public function parameters(): array
    {
        return [
            'user_id'    => ['type' => 'string', 'description' => 'Filter events by Amplitude user ID.'],
            'device_id'  => ['type' => 'string', 'description' => 'Filter events by device ID.'],
            'start'      => ['type' => 'string', 'description' => 'Start timestamp (ISO 8601 e.g. "2025-01-01T00:00:00Z" or milliseconds epoch).'],
            'end'        => ['type' => 'string', 'description' => 'End timestamp (ISO 8601 e.g. "2025-01-31T23:59:59Z" or milliseconds epoch).'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of events to return (default: 1000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $result = $this->service->listEvents(
                userId: $args['user_id'] ?? null,
                deviceId: $args['device_id'] ?? null,
                start: $args['start'] ?? null,
                end: $args['end'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : 1000,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
