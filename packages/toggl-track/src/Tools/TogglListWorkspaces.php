<?php

namespace OpenCompany\Integrations\TogglTrack\Tools;

use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * TogglListWorkspaces — List all workspaces accessible to the authenticated user.
 *
 * Retrieves all workspaces the user belongs to, including workspace ID, name,
 * and organization details. Useful for discovering workspace IDs needed by
 * other tools.
 *
 * @see https://developers.track.toggl.com/docs/api/workspaces#get-workspaces
 */
class TogglListWorkspaces implements Tool
{
    /**
     * Create a new TogglListWorkspaces tool instance.
     */
    public function __construct(
        private TogglTrackService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'toggl_list_workspaces';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List all Toggl Track workspaces accessible to the authenticated user. Returns workspace IDs and names needed for other operations.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed> Empty — this tool takes no parameters.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — list all workspaces.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     * @return ToolResult The list of workspaces or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl Track integration is not configured.');
            }

            $result = $this->service->listWorkspaces();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
