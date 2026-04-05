<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_get_task
 *
 * Get details for a single Teamwork task.
 */
class TeamworkGetTask implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_get_task';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Teamwork task, including description, status, assignees, dates, and subtasks.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'integer', 'required' => true, 'description' => 'The task ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $result = $this->service->getTask((int) $args['task_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
