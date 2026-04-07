<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MixpanelListEvents — List events from Mixpanel.
 *
 * Supports optional filtering by type, unit, and date range.
 * Calls GET /v1/events.
 */
class MixpanelListEvents implements Tool
{
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_list_events';
    }

    public function description(): string
    {
        return 'List events from Mixpanel Analytics. Optionally filter by event type, time unit, or date range. Returns the most recent events matching the criteria.';
    }

    public function parameters(): array
    {
        return [
            'type'  => ['type' => 'string', 'description' => 'Event type: "general" or "unique" (default: "general").'],
            'unit'  => ['type' => 'string', 'description' => 'Time unit: "hour", "day", "week", "month" (default: "day").'],
            'from'  => ['type' => 'string', 'description' => 'Start date in YYYY-MM-DD format.'],
            'to'    => ['type' => 'string', 'description' => 'End date in YYYY-MM-DD format.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of events to return (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $result = $this->service->listEvents(
                type: $args['type'] ?? null,
                unit: $args['unit'] ?? null,
                from: $args['from'] ?? null,
                to: $args['to'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
