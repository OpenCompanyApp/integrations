<?php

namespace OpenCompany\Integrations\MakeCom\Tools;

use OpenCompany\Integrations\MakeCom\MakeComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Make.com connections with optional filters.
 */
class MakeComListConnections implements Tool
{
    /**
     * @param  MakeComService  $service  The Make.com API client
     */
    public function __construct(
        private MakeComService $service,
    ) {}

    public function name(): string
    {
        return 'make_com_list_connections';
    }

    public function description(): string
    {
        return <<<'MD'
        List Make.com connections the authenticated user has access to.
        Supports filtering by team. Use this to inspect connected services
        and their status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'description' => 'Filter by team ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 20.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * List Make.com connections with optional filters.
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

            if (! empty($args['team_id'])) {
                $params['teamId'] = $args['team_id'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listConnections($params);
            $connections = $result['connections'] ?? [];

            return ToolResult::success([
                'connections' => $connections,
                'total' => count($connections),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
