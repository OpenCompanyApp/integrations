<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Toggl Track workspaces the authenticated user has access to.
 *
 * Returns workspace ID, name, and organization details needed as parameters
 * for other Toggl tools (projects, time entries).
 *
 * @see https://engineering.toggl.com/docs/api/workspaces#get-workspaces
 */
class TogglListWorkspaces implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_list_workspaces';
    }

    public function description(): string
    {
        return 'List all Toggl Track workspaces the user has access to. Returns workspace IDs needed for project and time entry operations.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $workspaces = $this->service->listWorkspaces();

            return ToolResult::success($workspaces);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
