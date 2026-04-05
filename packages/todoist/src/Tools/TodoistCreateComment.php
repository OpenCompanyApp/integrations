<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Create a comment on a Todoist task or project.
 */
class TodoistCreateComment implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_create_comment';
    }

    public function description(): string
    {
        return 'Add a comment to a Todoist task or project. Provide either task_id or project_id along with the content.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => false, 'description' => 'ID of the task to comment on (use this or project_id).'],
            'project_id' => ['type' => 'string', 'required' => false, 'description' => 'ID of the project to comment on (use this or task_id).'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The comment text.'],
        ];
    }

    /**
     * Create a comment on a Todoist task or project.
     *
     * @param array<string, mixed> $args Must contain 'content' and either 'task_id' or 'project_id'.
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

            $result = $this->service->createComment($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
