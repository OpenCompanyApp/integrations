<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects in Teamwork with optional filters.
 */
class TeamworkListProjects implements Tool
{
    /**
     * @param  TeamworkService  $service  The Teamwork API client
     */
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_list_projects';
    }

    public function description(): string
    {
        return 'List projects in Teamwork with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'status'  => ['type' => 'string',  'description' => 'Filter by project status (e.g. "active", "late", "completed").'],
            'page'    => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of projects per page (max 500).'],
        ];
    }

    /**
     * Retrieve a list of projects with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (status, page, pageSize)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['pageSize'])) {
                $params['pageSize'] = (int) $args['pageSize'];
            }

            $projects = $this->service->listProjects($params);

            return ToolResult::success($projects);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
