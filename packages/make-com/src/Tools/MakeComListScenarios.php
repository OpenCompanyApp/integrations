<?php

namespace OpenCompany\Integrations\MakeCom\Tools;

use OpenCompany\Integrations\MakeCom\MakeComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Make.com scenarios with optional filters.
 */
class MakeComListScenarios implements Tool
{
    /**
     * @param  MakeComService  $service  The Make.com API client
     */
    public function __construct(
        private MakeComService $service,
    ) {}

    public function name(): string
    {
        return 'make_com_list_scenarios';
    }

    public function description(): string
    {
        return <<<'MD'
        List Make.com scenarios the authenticated user has access to.
        Supports filtering by organization, team, or folder. Use this
        to discover scenario IDs needed for other tools.
        MD;
    }

    public function parameters(): array
    {
        return [
            'organization_id' => ['type' => 'string', 'description' => 'Filter by organization ID.'],
            'team_id' => ['type' => 'string', 'description' => 'Filter by team ID.'],
            'folder_id' => ['type' => 'string', 'description' => 'Filter by folder ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 20.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * List Make.com scenarios with optional filters.
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

            if (! empty($args['organization_id'])) {
                $params['organizationId'] = $args['organization_id'];
            }
            if (! empty($args['team_id'])) {
                $params['teamId'] = $args['team_id'];
            }
            if (! empty($args['folder_id'])) {
                $params['folderId'] = $args['folder_id'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listScenarios($params);
            $scenarios = $result['scenarios'] ?? [];

            return ToolResult::success([
                'scenarios' => $scenarios,
                'total' => count($scenarios),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
