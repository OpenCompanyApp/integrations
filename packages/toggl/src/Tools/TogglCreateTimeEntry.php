<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new time entry in a Toggl Track workspace.
 *
 * Accepts description, start time, duration, project, tags, and other
 * time entry properties. Returns the created time entry object.
 *
 * @see https://engineering.toggl.com/docs/api/time_entries#post-timeentry
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
        return 'Create a new time entry in a Toggl Track workspace.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'integer', 'required' => true, 'description' => 'The workspace ID.'],
            'description'  => ['type' => 'string', 'description' => 'Description of the time entry.'],
            'start'        => ['type' => 'string', 'required' => true, 'description' => 'Start time in ISO 8601 format (e.g., "2026-04-05T09:00:00Z").'],
            'stop'         => ['type' => 'string', 'description' => 'Stop time in ISO 8601 format. Omit for a running timer (duration should be -1).'],
            'duration'     => ['type' => 'integer', 'description' => 'Duration in seconds. Use -1 for a running timer.'],
            'project_id'   => ['type' => 'integer', 'description' => 'Project ID to associate with this time entry.'],
            'task_id'      => ['type' => 'integer', 'description' => 'Task ID to associate with this time entry.'],
            'tags'         => ['type' => 'array', 'description' => 'Array of tag names to associate with this time entry.'],
            'tag_ids'      => ['type' => 'array', 'description' => 'Array of tag IDs to associate with this time entry.'],
            'billable'     => ['type' => 'boolean', 'description' => 'Whether the time entry is billable.'],
            'created_with' => ['type' => 'string', 'description' => 'The name of the client app. Defaults to "OpenCompany".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $workspaceId = (int) ($args['workspace_id'] ?? 0);

            if ($workspaceId === 0) {
                return ToolResult::error('workspace_id is required.');
            }

            if (empty($args['start'])) {
                return ToolResult::error('start is required (ISO 8601 date-time).');
            }

            $data = [
                'start'        => $args['start'],
                'created_with' => $args['created_with'] ?? 'OpenCompany',
            ];

            $optionalFields = ['description', 'stop', 'duration', 'project_id', 'task_id', 'tags', 'tag_ids', 'billable'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $entry = $this->service->createTimeEntry($workspaceId, $data);

            return ToolResult::success($entry);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
