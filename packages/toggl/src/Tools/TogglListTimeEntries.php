<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: toggl_list_time_entries
 *
 * Lists recent Toggl time entries with optional date range filters.
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
        return 'List recent Toggl time entries. Optionally filter by date range.';
    }

    public function parameters(): array
    {
        return [
            'start_date' => ['type' => 'string', 'description' => 'Start date filter (ISO 8601 date, e.g. "2026-01-01").'],
            'end_date'   => ['type' => 'string', 'description' => 'End date filter (ISO 8601 date).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $result = $this->service->listTimeEntries(
                startDate: $args['start_date'] ?? null,
                endDate: $args['end_date'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
