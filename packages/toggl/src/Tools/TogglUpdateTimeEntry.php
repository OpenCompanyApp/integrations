<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing time entry in Toggl Track.
 *
 * Accepts the time entry ID along with any fields to update (description,
 * start, stop, duration, project, tags, billable, etc.).
 *
 * @see https://engineering.toggl.com/docs/api/time_entries#put-timeentry
 */
class TogglUpdateTimeEntry implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_update_time_entry';
    }

    public function description(): string
    {
        return 'Update an existing time entry in Toggl Track. Use this to edit description, times, project, tags, or billable status.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id'  => ['type' => 'integer', 'required' => true, 'description' => 'The workspace ID.'],
            'time_entry_id' => ['type' => 'integer', 'required' => true, 'description' => 'The time entry ID to update.'],
            'description'   => ['type' => 'string', 'description' => 'Updated description.'],
            'start'         => ['type' => 'string', 'description' => 'Updated start time in ISO 8601 format.'],
            'stop'          => ['type' => 'string', 'description' => 'Updated stop time in ISO 8601 format.'],
            'duration'      => ['type' => 'integer', 'description' => 'Updated duration in seconds.'],
            'project_id'    => ['type' => 'integer', 'description' => 'Updated project ID.'],
            'task_id'       => ['type' => 'integer', 'description' => 'Updated task ID.'],
            'tags'          => ['type' => 'array', 'description' => 'Updated array of tag names.'],
            'tag_ids'       => ['type' => 'array', 'description' => 'Updated array of tag IDs.'],
            'billable'      => ['type' => 'boolean', 'description' => 'Updated billable status.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $workspaceId  = (int) ($args['workspace_id'] ?? 0);
            $timeEntryId  = (int) ($args['time_entry_id'] ?? 0);

            if ($workspaceId === 0) {
                return ToolResult::error('workspace_id is required.');
            }

            if ($timeEntryId === 0) {
                return ToolResult::error('time_entry_id is required.');
            }

            $data = [];

            $updatableFields = ['description', 'start', 'stop', 'duration', 'project_id', 'task_id', 'tags', 'tag_ids', 'billable'];
            foreach ($updatableFields as $field) {
                if (array_key_exists($field, $args)) {
                    $data[$field] = $args[$field];
                }
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required.');
            }

            $entry = $this->service->updateTimeEntry($workspaceId, $timeEntryId, $data);

            return ToolResult::success($entry);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
