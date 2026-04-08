<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_list_teams
 *
 * List teams from Teamwork.
 */
class TeamworkListTeams implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_list_teams';
    }

    public function description(): string
    {
        return 'List teams in Teamwork. Returns team names, IDs, and member counts.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
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

            $result = $this->service->listTeams($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
