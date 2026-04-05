<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all workspaces the authenticated user has access to.
 */
class AsanaListWorkspaces implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_workspaces';
    }

    public function description(): string
    {
        return 'List all workspaces the authenticated user has access to.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve all workspaces for the authenticated user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $workspaces = $this->service->listWorkspaces();

            return ToolResult::success($workspaces);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
