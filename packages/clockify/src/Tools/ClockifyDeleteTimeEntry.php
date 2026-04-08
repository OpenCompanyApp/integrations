<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_delete_time_entry
 *
 * Deletes a Clockify time entry.
 */
class ClockifyDeleteTimeEntry implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_delete_time_entry';
    }

    public function description(): string
    {
        return 'Delete a Clockify time entry. This action cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id'  => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'time_entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The time entry ID to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $this->service->deleteTimeEntry($args['workspace_id'], $args['time_entry_id']);

            return ToolResult::success('Time entry deleted.');
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
