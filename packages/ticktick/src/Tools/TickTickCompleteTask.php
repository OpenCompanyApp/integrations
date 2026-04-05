<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickCompleteTask implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_complete_task';
    }

    public function description(): string
    {
        return 'Mark a TickTick task as complete.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID the task belongs to.'],
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The task ID to complete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $this->service->completeTask($args['project_id'], $args['task_id']);

            return ToolResult::success("Task '{$args['task_id']}' marked as complete.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
