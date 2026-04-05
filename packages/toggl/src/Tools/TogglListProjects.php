<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all projects in a Toggl Track workspace.
 *
 * Returns project details including ID, name, color, billable flag, active
 * status, and estimated hours. Use the workspace ID from toggl_list_workspaces.
 *
 * @see https://engineering.toggl.com/docs/api/projects#get-projects
 */
class TogglListProjects implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_list_projects';
    }

    public function description(): string
    {
        return 'List all projects in a Toggl Track workspace. Use this to find project IDs for time entries.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'integer', 'required' => true, 'description' => 'The workspace ID (find it using toggl_list_workspaces).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $workspaceId = (int) ($args['workspace_id'] ?? 0);

            if ($workspaceId === 0) {
                return ToolResult::error('workspace_id is required.');
            }

            $projects = $this->service->listProjects($workspaceId);

            return ToolResult::success($projects);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
