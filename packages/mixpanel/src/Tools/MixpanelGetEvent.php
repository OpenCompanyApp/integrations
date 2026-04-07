<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MixpanelGetEvent — Retrieve event data by event name.
 *
 * Calls GET /v1/events with the event name and returns analytics
 * data for the specified event.
 */
class MixpanelGetEvent implements Tool
{
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_get_event';
    }

    public function description(): string
    {
        return 'Retrieve analytics data for a specific Mixpanel event by name. Returns event counts and breakdowns over time.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The event name to retrieve data for.'],
            'type' => ['type' => 'string', 'description' => 'Event type: "general" or "unique" (default: "general").'],
            'unit' => ['type' => 'string', 'description' => 'Time unit: "hour", "day", "week", "month" (default: "day").'],
            'from' => ['type' => 'string', 'description' => 'Start date in YYYY-MM-DD format.'],
            'to'   => ['type' => 'string', 'description' => 'End date in YYYY-MM-DD format.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $result = $this->service->getEvent(
                name: $args['name'],
                type: $args['type'] ?? null,
                unit: $args['unit'] ?? null,
                from: $args['from'] ?? null,
                to: $args['to'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
