<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List time entries for the authenticated Toggl Track user.
 *
 * Returns time entry details including ID, description, start/stop times,
 * duration, project, and tags. Optionally filter by date range.
 *
 * @see https://engineering.toggl.com/docs/api/time_entries#get-timeentries
 */
class TogglListTimeEntries implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_list_time_entries';
    }

    public function description(): string
    {
        return 'List time entries for the authenticated user. Optionally filter by date range.';
    }

    public function parameters(): array
    {
        return [
            'start_date' => ['type' => 'string', 'description' => 'Start date in ISO 8601 format (e.g., "2026-01-01"). Defaults to 9 days ago if not specified.'],
            'end_date'   => ['type' => 'string', 'description' => 'End date in ISO 8601 format (e.g., "2026-01-31"). Defaults to now if not specified.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $startDate = $args['start_date'] ?? null;
            $endDate   = $args['end_date'] ?? null;

            $entries = $this->service->listTimeEntries($startDate, $endDate);

            return ToolResult::success($entries);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
