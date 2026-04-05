<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the user task list for a given user and workspace.
 */
class AsanaGetUserTaskList implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_get_user_task_list';
    }

    public function description(): string
    {
        return 'Get the user task list for a given user and workspace.';
    }

    public function parameters(): array
    {
        return [
            'user_id'      => ['type' => 'string', 'required' => true, 'description' => 'GID of the user.'],
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'GID of the workspace.'],
        ];
    }

    /**
     * Retrieve the user task list for a specific user and workspace.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, workspace_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';
            $workspaceId = $args['workspace_id'] ?? '';

            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }
            if (empty($workspaceId)) {
                return ToolResult::error('workspace_id is required.');
            }

            $taskList = $this->service->getUserTaskList($userId, $workspaceId);

            return ToolResult::success($taskList);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
