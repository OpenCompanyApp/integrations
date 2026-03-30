<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpGetTask implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_get_task';
    }

    public function description(): string
    {
        return <<<'MD'
        Get a single ClickUp task by ID with full details.
        Supports both regular IDs and custom IDs (e.g., "DEV-42").
        Optionally include subtask details.
        MD;
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID. Supports regular IDs or custom IDs like "DEV-42".'],
            'include_subtasks' => ['type' => 'boolean', 'description' => 'Include subtask details. Default: false.'],
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

            $params = $this->service->withCustomIdParams($taskId);

            if (isset($args['include_subtasks']) && $args['include_subtasks']) {
                $params['include_subtasks'] = 'true';
            }

            $task = $this->service->getTask($taskId, $params);

            $output = [
                'id' => $task['id'] ?? '',
                'custom_id' => $task['custom_id'] ?? null,
                'name' => $task['name'] ?? '',
                'description' => $task['description'] ?? '',
                'status' => $task['status']['status'] ?? '',
                'priority' => $task['priority']['priority'] ?? null,
                'assignees' => array_map(fn (array $a) => [
                    'id' => $a['id'] ?? '',
                    'username' => $a['username'] ?? '',
                ], $task['assignees'] ?? []),
                'tags' => array_map(fn (array $t) => $t['name'] ?? '', $task['tags'] ?? []),
                'due_date' => isset($task['due_date']) ? ClickUpService::fromMillis((int) $task['due_date']) : null,
                'start_date' => isset($task['start_date']) ? ClickUpService::fromMillis((int) $task['start_date']) : null,
                'time_estimate' => $task['time_estimate'] ?? null,
                'url' => $task['url'] ?? '',
                'list' => [
                    'id' => $task['list']['id'] ?? '',
                    'name' => $task['list']['name'] ?? '',
                ],
                'folder' => [
                    'id' => $task['folder']['id'] ?? '',
                    'name' => $task['folder']['name'] ?? '',
                ],
                'space' => [
                    'id' => $task['space']['id'] ?? '',
                ],
            ];

            if (! empty($task['subtasks'])) {
                $output['subtasks'] = array_map(fn (array $st) => [
                    'id' => $st['id'] ?? '',
                    'name' => $st['name'] ?? '',
                    'status' => $st['status']['status'] ?? '',
                ], $task['subtasks']);
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
