<?php

namespace OpenCompany\Integrations\Motion\Tools;

use OpenCompany\Integrations\Motion\MotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MotionGetTask implements Tool
{
    public function __construct(
        private MotionService $service,
    ) {}

    public function name(): string
    {
        return 'motion_get_task';
    }

    public function description(): string
    {
        return 'Get details of a specific task in Motion by its ID. Returns the task name, description, status, assignee, due date, priority, and project.';
    }

    public function parameters(): array
    {
        return [
            'taskId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the task.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Motion integration is not configured.');
            }

            $result = $this->service->getTask($args['taskId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
