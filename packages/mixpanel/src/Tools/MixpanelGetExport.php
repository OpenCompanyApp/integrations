<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Export raw event data from Mixpanel.
 *
 * Uses the Mixpanel data export endpoint to retrieve raw event records
 * for a given date range, optionally filtered by event name(s).
 */
class MixpanelGetExport implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_get_export';
    }

    public function description(): string
    {
        return 'Export raw event data from Mixpanel for a date range.';
    }

    public function parameters(): array
    {
        return [
            'from_date' => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format.'],
            'to_date'   => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format.'],
            'event'     => ['type' => 'string', 'description' => 'Event name or JSON array of event names to export. Leave empty for all events.'],
        ];
    }

    /**
     * Export raw event data from Mixpanel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from_date, to_date, event)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $fromDate = $args['from_date'] ?? '';
            $toDate = $args['to_date'] ?? '';

            if (empty($fromDate)) {
                return ToolResult::error('from_date is required.');
            }
            if (empty($toDate)) {
                return ToolResult::error('to_date is required.');
            }

            $event = $args['event'] ?? [];
            if (is_string($event) && ! empty($event)) {
                $decoded = json_decode($event, true);
                $event = is_array($decoded) ? $decoded : [$event];
            }

            $result = $this->service->getExport($fromDate, $toDate, $event);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
