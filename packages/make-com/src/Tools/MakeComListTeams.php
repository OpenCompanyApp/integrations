<?php

namespace OpenCompany\Integrations\MakeCom\Tools;

use OpenCompany\Integrations\MakeCom\MakeComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Make.com teams (organizations) the authenticated user has access to.
 */
class MakeComListTeams implements Tool
{
    /**
     * @param  MakeComService  $service  The Make.com API client
     */
    public function __construct(
        private MakeComService $service,
    ) {}

    public function name(): string
    {
        return 'make_com_list_teams';
    }

    public function description(): string
    {
        return <<<'MD'
        List Make.com teams (organizations) the authenticated user has access to.
        Use this to discover team IDs needed for filtering scenarios and connections.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 20.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * List Make.com teams.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Make.com integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listTeams($params);
            $teams = $result['teams'] ?? $result['organizations'] ?? [];

            return ToolResult::success([
                'teams' => $teams,
                'total' => count($teams),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
