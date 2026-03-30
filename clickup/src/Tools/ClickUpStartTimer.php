<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpStartTimer implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_start_timer';
    }

    public function description(): string
    {
        return 'Start a time tracking timer on a ClickUp task.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID to start the timer on.'],
            'description' => ['type' => 'string', 'description' => 'Description for the time entry.'],
            'billable' => ['type' => 'boolean', 'description' => 'Whether the time is billable.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated tag names for the time entry.'],
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID. Uses configured default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $taskId = $args['task_id'] ?? '';
            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }

            $data = [];
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['billable'])) {
                $data['billable'] = (bool) $args['billable'];
            }
            if (isset($args['tags'])) {
                $tags = is_string($args['tags']) ? explode(',', $args['tags']) : $args['tags'];
                $data['tags'] = array_map(fn (string $t) => ['name' => trim($t)], $tags);
            }

            $result = $this->service->startTimeEntry($workspaceId, $taskId, $data);

            return ToolResult::success($result['data'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
