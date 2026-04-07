<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: toggl_list_projects
 *
 * Lists projects in a Toggl workspace.
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
        return 'List projects in a Toggl workspace. Optionally filter for active projects only.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'active'       => ['type' => 'boolean', 'description' => 'Filter for active projects only (default: true).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $result = $this->service->listProjects(
                workspaceId: $args['workspace_id'],
                active: $args['active'] ?? true,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
