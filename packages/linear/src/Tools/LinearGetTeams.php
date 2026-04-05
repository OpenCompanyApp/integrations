<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve all teams the authenticated user has access to, including their members.
 */
class LinearGetTeams implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_get_teams';
    }

    public function description(): string
    {
        return <<<'MD'
        Get all Linear teams the authenticated user has access to, including
        team name, key, description, and member list. Use this to discover
        team IDs needed for other tools.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch all teams with their members.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $result = $this->service->getTeams();
            $teams = $result['data']['teams']['nodes'] ?? [];

            $nodes = array_map(function (array $team) {
                return [
                    'id' => $team['id'] ?? '',
                    'name' => $team['name'] ?? '',
                    'key' => $team['key'] ?? '',
                    'description' => $team['description'] ?? '',
                    'icon' => $team['icon'] ?? '',
                    'members' => array_map(fn (array $m) => [
                        'id' => $m['id'] ?? '',
                        'name' => $m['name'] ?? '',
                        'email' => $m['email'] ?? '',
                    ], $team['members']['nodes'] ?? []),
                ];
            }, $teams);

            return ToolResult::success([
                'teams' => $nodes,
                'total' => count($nodes),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
