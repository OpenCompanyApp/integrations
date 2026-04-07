<?php

namespace OpenCompany\Integrations\PlanetScale\Tools;

use OpenCompany\Integrations\PlanetScale\PlanetScaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlanetScaleListBranches implements Tool
{
    public function __construct(
        private PlanetScaleService $service,
    ) {}

    public function name(): string
    {
        return 'planetscale_list_branches';
    }

    public function description(): string
    {
        return 'List branches of a PlanetScale database. Returns a paginated list of branches with their names, roles, and states.';
    }

    public function parameters(): array
    {
        return [
            'organization' => ['type' => 'string', 'required' => true, 'description' => 'The organization name.'],
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Results per page (default: 20, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PlanetScale integration is not configured.');
            }

            if (empty($args['organization'])) {
                return ToolResult::error('The organization name is required.');
            }

            if (empty($args['database'])) {
                return ToolResult::error('The database name is required.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listBranches($args['organization'], $args['database'], $page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
