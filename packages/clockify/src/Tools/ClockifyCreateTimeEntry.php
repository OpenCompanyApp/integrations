<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_create_time_entry
 *
 * Creates a new time entry in a Clockify workspace.
 */
class ClockifyCreateTimeEntry implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_create_time_entry';
    }

    public function description(): string
    {
        return 'Create a new time entry in a Clockify workspace. Provide start/end times, a description, and optionally a project.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'start'        => ['type' => 'string', 'required' => true, 'description' => 'Start time (ISO 8601, e.g. "2026-04-05T09:00:00Z").'],
            'end'          => ['type' => 'string', 'required' => true, 'description' => 'End time (ISO 8601, e.g. "2026-04-05T17:00:00Z").'],
            'description'  => ['type' => 'string', 'description' => 'Description of the time entry.'],
            'project_id'   => ['type' => 'string', 'description' => 'Project ID to assign the time entry to.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->createTimeEntry(
                workspaceId: $args['workspace_id'],
                start: $args['start'],
                end: $args['end'],
                description: $args['description'] ?? '',
                projectId: $args['project_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
