<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_list_tasks
 *
 * Lists tasks for a Clockify project.
 */
class ClockifyListTasks implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks for a Clockify project.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'project_id'   => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
            'page'         => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'page_size'    => ['type' => 'integer', 'description' => 'Items per page (default: 50).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->listTasks(
                workspaceId: $args['workspace_id'],
                projectId: $args['project_id'],
                page: $args['page'] ?? 1,
                pageSize: $args['page_size'] ?? 50,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
