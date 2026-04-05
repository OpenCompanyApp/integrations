<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_list_projects
 *
 * List projects from Teamwork.
 */
class TeamworkListProjects implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_list_projects';
    }

    public function description(): string
    {
        return 'List projects in Teamwork. Returns project names, statuses, and IDs you can use to query tasks, time entries, and more.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
            'search'   => ['type' => 'string',  'description' => 'Filter projects by name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $params = [];
            if (isset($args['page']))     $params['page']     = (int) $args['page'];
            if (isset($args['pageSize'])) $params['pageSize'] = (int) $args['pageSize'];
            if (isset($args['search']))   $params['search']   = $args['search'];

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
