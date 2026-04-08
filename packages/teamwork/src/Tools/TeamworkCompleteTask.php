<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_complete_task
 *
 * Mark a Teamwork task as complete.
 */
class TeamworkCompleteTask implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_complete_task';
    }

    public function description(): string
    {
        return 'Mark a Teamwork task as complete. Provide the task ID.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'integer', 'required' => true, 'description' => 'The task ID to mark as complete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $result = $this->service->completeTask((int) $args['task_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
