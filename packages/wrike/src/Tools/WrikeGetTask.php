<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Wrike task.
 */
class WrikeGetTask implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_get_task';
    }

    public function description(): string
    {
        return 'Get detailed information about a Wrike task.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The task ID.'],
        ];
    }

    /**
     * Retrieve a task by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (task_id)
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

            $task = $this->service->getTask($taskId);

            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
