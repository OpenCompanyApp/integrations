<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_list_time_entries
 *
 * Lists time entries in a Clockify workspace with optional filters.
 */
class ClockifyListTimeEntries implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_list_time_entries';
    }

    public function description(): string
    {
        return 'List time entries in a Clockify workspace. Optionally filter by date range or project.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'start'        => ['type' => 'string', 'description' => 'Start date filter (ISO 8601, e.g. "2026-01-01T00:00:00Z").'],
            'end'          => ['type' => 'string', 'description' => 'End date filter (ISO 8601).'],
            'project'      => ['type' => 'string', 'description' => 'Filter by project ID.'],
            'page'         => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'page_size'    => ['type' => 'integer', 'description' => 'Items per page (default: 50).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->listTimeEntries(
                workspaceId: $args['workspace_id'],
                start: $args['start'] ?? null,
                end: $args['end'] ?? null,
                project: $args['project'] ?? null,
                page: $args['page'] ?? 1,
                pageSize: $args['page_size'] ?? 50,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
