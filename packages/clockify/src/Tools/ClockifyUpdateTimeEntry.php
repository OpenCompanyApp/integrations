<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_update_time_entry
 *
 * Updates an existing Clockify time entry.
 */
class ClockifyUpdateTimeEntry implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_update_time_entry';
    }

    public function description(): string
    {
        return 'Update an existing Clockify time entry. Provide the fields you want to change.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id'  => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'time_entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The time entry ID.'],
            'start'         => ['type' => 'string', 'description' => 'New start time (ISO 8601).'],
            'end'           => ['type' => 'string', 'description' => 'New end time (ISO 8601).'],
            'description'   => ['type' => 'string', 'description' => 'New description.'],
            'project_id'    => ['type' => 'string', 'description' => 'New project ID to assign.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $workspaceId = $args['workspace_id'];
            $timeEntryId = $args['time_entry_id'];

            $data = [];
            if (isset($args['start'])) {
                $data['start'] = $args['start'];
            }
            if (isset($args['end'])) {
                $data['end'] = $args['end'];
            }
            if (array_key_exists('description', $args)) {
                $data['description'] = $args['description'];
            }
            if (isset($args['project_id'])) {
                $data['projectId'] = $args['project_id'];
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Pass at least one of: start, end, description, project_id.');
            }

            $result = $this->service->updateTimeEntry($workspaceId, $timeEntryId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
