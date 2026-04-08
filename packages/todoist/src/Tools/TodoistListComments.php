<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * List comments for a Todoist task or project.
 */
class TodoistListComments implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_list_comments';
    }

    public function description(): string
    {
        return 'List comments for a Todoist task or project. Provide either task_id or project_id.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => false, 'description' => 'ID of the task to list comments for.'],
            'project_id' => ['type' => 'string', 'required' => false, 'description' => 'ID of the project to list comments for.'],
        ];
    }

    /**
     * List comments for a Todoist task or project.
     *
     * @param array<string, mixed> $args Must contain either 'task_id' or 'project_id'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            if (empty($args['task_id']) && empty($args['project_id'])) {
                return ToolResult::error('Either task_id or project_id is required.');
            }

            $result = $this->service->listComments(
                taskId: $args['task_id'] ?? null,
                projectId: $args['project_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
