<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpUpdateTask implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_update_task';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing ClickUp task.
        Supports changing name, description, status, priority, assignees, and dates.
        Set status to "closed" to complete a task.
        Supports custom task IDs like "DEV-42".
        MD;
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID to update. Supports custom IDs like "DEV-42".'],
            'name' => ['type' => 'string', 'description' => 'New task name.'],
            'description' => ['type' => 'string', 'description' => 'New task description.'],
            'status' => ['type' => 'string', 'description' => 'New status. Set to "closed" to complete the task.'],
            'priority' => ['type' => 'integer', 'description' => 'Priority: 1=urgent, 2=high, 3=normal, 4=low.'],
            'assignees' => ['type' => 'string', 'description' => 'Comma-separated user IDs to add as assignees.'],
            'remove_assignees' => ['type' => 'string', 'description' => 'Comma-separated user IDs to remove as assignees.'],
            'due_date' => ['type' => 'string', 'description' => 'New due date (ISO 8601). Empty string to clear.'],
            'start_date' => ['type' => 'string', 'description' => 'New start date (ISO 8601). Empty string to clear.'],
            'time_estimate' => ['type' => 'integer', 'description' => 'Time estimate in minutes.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';
            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }

            $data = [];

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['priority'])) {
                $data['priority'] = (int) $args['priority'];
            }
            if (isset($args['assignees'])) {
                $assignees = is_string($args['assignees']) ? explode(',', $args['assignees']) : $args['assignees'];
                $data['assignees'] = ['add' => array_map('intval', array_map('trim', $assignees))];
            }
            if (isset($args['remove_assignees'])) {
                $remove = is_string($args['remove_assignees']) ? explode(',', $args['remove_assignees']) : $args['remove_assignees'];
                $data['assignees'] = array_merge($data['assignees'] ?? [], [
                    'rem' => array_map('intval', array_map('trim', $remove)),
                ]);
            }
            if (isset($args['due_date'])) {
                if ($args['due_date'] === '') {
                    $data['due_date'] = null;
                } else {
                    $data['due_date'] = ClickUpService::toMillis($args['due_date']);
                    $data['due_date_time'] = true;
                }
            }
            if (isset($args['start_date'])) {
                if ($args['start_date'] === '') {
                    $data['start_date'] = null;
                } else {
                    $data['start_date'] = ClickUpService::toMillis($args['start_date']);
                    $data['start_date_time'] = true;
                }
            }
            if (isset($args['time_estimate'])) {
                $data['time_estimate'] = (int) $args['time_estimate'] * 60000; // minutes to ms
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required.');
            }

            // Handle custom task IDs
            $queryParams = $this->service->withCustomIdParams($taskId);
            if (! empty($queryParams)) {
                // Append query params to the task ID URL
                $taskId .= '?' . http_build_query($queryParams);
            }

            $result = $this->service->updateTask($taskId, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'status' => $result['status']['status'] ?? '',
                'url' => $result['url'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
