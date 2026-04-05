<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Wrike task.
 */
class WrikeUpdateTask implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_update_task';
    }

    public function description(): string
    {
        return 'Update an existing Wrike task.';
    }

    public function parameters(): array
    {
        return [
            'task_id'     => ['type' => 'string', 'required' => true,  'description' => 'The task ID to update.'],
            'title'       => ['type' => 'string', 'description' => 'New title for the task.'],
            'description' => ['type' => 'string', 'description' => 'New description for the task.'],
            'status'      => ['type' => 'string', 'description' => 'New status (e.g. Active, Completed, Deferred).'],
            'importance'  => ['type' => 'string', 'description' => 'Task importance: High, Normal, or Low.'],
            'dates_due'   => ['type' => 'string', 'description' => 'New due date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Update a task's fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (task_id, title, description, status, importance, dates_due)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';

            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }

            $data = [];

            if (array_key_exists('title', $args)) {
                $data['title'] = $args['title'];
            }
            if (array_key_exists('description', $args)) {
                $data['description'] = $args['description'];
            }
            if (array_key_exists('status', $args)) {
                $data['status'] = $args['status'];
            }
            if (array_key_exists('importance', $args)) {
                $data['importance'] = $args['importance'];
            }
            if (array_key_exists('dates_due', $args)) {
                $data['dates'] = ['due' => $args['dates_due']];
            }

            $task = $this->service->updateTask($taskId, $data);

            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
