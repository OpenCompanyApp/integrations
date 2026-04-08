<?php

namespace OpenCompany\Integrations\Harvest\Tools;

use OpenCompany\Integrations\Harvest\HarvestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Harvest time entry.
 *
 * Requires a project_id, task_id, and spent_date. Optionally
 * includes hours, notes, and a timer start timestamp.
 */
class HarvestCreateTimeEntry implements Tool
{
    /**
     * @param  HarvestService  $service  The Harvest API client
     */
    public function __construct(
        private HarvestService $service,
    ) {}

    public function name(): string
    {
        return 'harvest_create_time_entry';
    }

    public function description(): string
    {
        return 'Create a new Harvest time entry for a project and task.';
    }

    public function parameters(): array
    {
        return [
            'project_id'      => ['type' => 'integer', 'required' => true, 'description' => 'Project ID to log time against.'],
            'task_id'         => ['type' => 'integer', 'required' => true, 'description' => 'Task ID to associate with the entry.'],
            'spent_date'      => ['type' => 'string',  'required' => true, 'description' => 'Date the time was spent (YYYY-MM-DD).'],
            'hours'           => ['type' => 'number',  'description' => 'Number of hours logged (e.g. 1.5).'],
            'notes'           => ['type' => 'string',  'description' => 'Notes describing the time entry.'],
            'timer_started_at' => ['type' => 'string',  'description' => 'ISO 8601 timestamp when the timer was started.'],
        ];
    }

    /**
     * Create a new time entry.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, task_id, spent_date, hours, notes, timer_started_at)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Harvest integration is not configured.');
            }

            $projectId = $args['project_id'] ?? null;
            $taskId    = $args['task_id'] ?? null;
            $spentDate = $args['spent_date'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('project_id is required.');
            }
            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }
            if (empty($spentDate)) {
                return ToolResult::error('spent_date is required.');
            }

            $data = [
                'project_id' => (int) $projectId,
                'task_id'    => (int) $taskId,
                'spent_date' => $spentDate,
            ];

            if (isset($args['hours'])) {
                $data['hours'] = (float) $args['hours'];
            }
            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['timer_started_at'])) {
                $data['timer_started_at'] = $args['timer_started_at'];
            }

            $result = $this->service->createTimeEntry($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
