<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a time entry from Toggl Track.
 *
 * Permanently removes the specified time entry. This action cannot be undone.
 *
 * @see https://engineering.toggl.com/docs/api/time_entries#delete-timeentry
 */
class TogglDeleteTimeEntry implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_delete_time_entry';
    }

    public function description(): string
    {
        return 'Delete a time entry from Toggl Track. This action is permanent and cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id'  => ['type' => 'integer', 'required' => true, 'description' => 'The workspace ID.'],
            'time_entry_id' => ['type' => 'integer', 'required' => true, 'description' => 'The time entry ID to delete.'],
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

            $this->service->deleteTimeEntry($workspaceId, $timeEntryId);

            return ToolResult::success("Time entry {$timeEntryId} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
