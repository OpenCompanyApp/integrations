<?php

namespace OpenCompany\Integrations\TogglTrack\Tools;

use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * TogglListProjects — List projects accessible to the authenticated user.
 *
 * Retrieves projects from Toggl Track with optional filtering by workspace
 * and active status.
 *
 * @see https://developers.track.toggl.com/docs/api/projects#get-projects
 */
class TogglListProjects implements Tool
{
    /**
     * Create a new TogglListProjects tool instance.
     */
    public function __construct(
        private TogglTrackService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'toggl_list_projects';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List projects from Toggl Track. Optionally filter by workspace or active status.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'active' => ['type' => 'boolean', 'description' => 'Filter by active status. true for active projects only, false for archived.'],
            'workspace_id' => ['type' => 'integer', 'description' => 'Filter by workspace ID.'],
        ];
    }

    /**
     * Execute the tool — list projects with optional filters.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The list of projects or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl Track integration is not configured.');
            }

            $params = [];

            if (isset($args['active'])) {
                $params['active'] = $args['active'] ? 'true' : 'false';
            }
            if (isset($args['workspace_id'])) {
                $params['workspace_id'] = (int) $args['workspace_id'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
