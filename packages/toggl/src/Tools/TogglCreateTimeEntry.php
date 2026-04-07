<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: toggl_create_time_entry
 *
 * Creates a new time entry in a Toggl workspace.
 */
class TogglCreateTimeEntry implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_create_time_entry';
    }

    public function description(): string
    {
        return 'Create a new time entry in a Toggl workspace. Provide a description, start time, and optionally a project and stop time.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'description'  => ['type' => 'string', 'description' => 'Description of the time entry.'],
            'start'        => ['type' => 'string', 'description' => 'Start time (ISO 8601, e.g. "2026-04-05T09:00:00Z"). Defaults to now.'],
            'stop'         => ['type' => 'string', 'description' => 'Stop time (ISO 8601). Omit for a running timer.'],
            'duration'     => ['type' => 'integer', 'description' => 'Duration in seconds. Use -1 for a running timer (default: -1).'],
            'project_id'   => ['type' => 'string', 'description' => 'Project ID to assign the time entry to.'],
            'tags'         => ['type' => 'array', 'description' => 'Tags for the time entry.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $result = $this->service->createTimeEntry(
                workspaceId: $args['workspace_id'],
                description: $args['description'] ?? '',
                tags: $args['tags'] ?? [],
                duration: (string) ($args['duration'] ?? -1),
                start: $args['start'] ?? '',
                stop: $args['stop'] ?? null,
                projectId: $args['project_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
