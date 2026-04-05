<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpDeleteTask implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_delete_task';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a ClickUp task permanently.
        Supports custom task IDs like "DEV-42".
        This action cannot be undone.
        MD;
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID to delete. Supports custom IDs like "DEV-42".'],
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

            $queryParams = $this->service->withCustomIdParams($taskId);
            $deleteId = $taskId;
            if (! empty($queryParams)) {
                $deleteId .= '?' . http_build_query($queryParams);
            }

            $this->service->deleteTask($deleteId);

            return ToolResult::success("Task '{$taskId}' deleted successfully.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
