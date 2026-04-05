<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects in Asana with optional filters.
 */
class AsanaListProjects implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_projects';
    }

    public function description(): string
    {
        return 'List projects in Asana with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string',  'description' => 'Workspace GID to filter projects by.'],
            'team'      => ['type' => 'string',  'description' => 'Team GID to filter projects by.'],
            'archived'  => ['type' => 'boolean', 'description' => 'Filter by archived status.'],
            'limit'     => ['type' => 'integer', 'description' => 'Max number of projects to return (1–100).'],
            'offset'    => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of projects with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, team, archived, limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $params = [];

            if (isset($args['workspace'])) {
                $params['workspace'] = $args['workspace'];
            }
            if (isset($args['team'])) {
                $params['team'] = $args['team'];
            }
            if (isset($args['archived'])) {
                $params['archived'] = $args['archived'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = $args['offset'];
            }

            $projects = $this->service->listProjects($params);

            return ToolResult::success($projects);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
