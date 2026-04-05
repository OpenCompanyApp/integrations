<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List teams in an Asana workspace.
 */
class AsanaListTeams implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_teams';
    }

    public function description(): string
    {
        return 'List teams in an Asana workspace.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'GID of the workspace to list teams for.'],
        ];
    }

    /**
     * Retrieve teams for the specified workspace.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? '';

            if (empty($workspaceId)) {
                return ToolResult::error('workspace_id is required.');
            }

            $teams = $this->service->listTeams($workspaceId);

            return ToolResult::success($teams);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
