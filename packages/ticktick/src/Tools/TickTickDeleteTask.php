<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickDeleteTask implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_delete_task';
    }

    public function description(): string
    {
        return 'Delete a TickTick task. This action cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID the task belongs to.'],
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The task ID to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $this->service->deleteTask($args['project_id'], $args['task_id']);

            return ToolResult::success("Task '{$args['task_id']}' deleted successfully.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
