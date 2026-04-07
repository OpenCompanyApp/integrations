<?php

namespace OpenCompany\Integrations\Teams\Tools;

use OpenCompany\Integrations\Teams\TeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Microsoft Teams the user is a member of.
 *
 * Supports pagination via top and skip parameters.
 */
class TeamsListTeams implements Tool
{
    /**
     * @param  TeamsService  $service  The Microsoft Graph API client
     */
    public function __construct(
        private TeamsService $service,
    ) {}

    public function name(): string
    {
        return 'teams_list_teams';
    }

    public function description(): string
    {
        return 'List all Microsoft Teams the user is a member of.';
    }

    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Number of teams to return (default 20, max 999).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of teams to skip for pagination.'],
        ];
    }

    /**
     * List teams with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $params = [];

            if (isset($args['top'])) {
                $params['$top'] = (int) $args['top'];
            }
            if (isset($args['skip'])) {
                $params['$skip'] = (int) $args['skip'];
            }

            $result = $this->service->listTeams($params);

            return ToolResult::success([
                'ok' => true,
                'teams' => $result['value'] ?? [],
                '@odata.nextLink' => $result['@odata.nextLink'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
