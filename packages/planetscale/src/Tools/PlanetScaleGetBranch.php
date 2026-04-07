<?php

namespace OpenCompany\Integrations\PlanetScale\Tools;

use OpenCompany\Integrations\PlanetScale\PlanetScaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlanetScaleGetBranch implements Tool
{
    public function __construct(
        private PlanetScaleService $service,
    ) {}

    public function name(): string
    {
        return 'planetscale_get_branch';
    }

    public function description(): string
    {
        return 'Get details of a specific branch of a PlanetScale database, including its role, region, and readiness.';
    }

    public function parameters(): array
    {
        return [
            'organization' => ['type' => 'string', 'required' => true, 'description' => 'The organization name.'],
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'branch' => ['type' => 'string', 'required' => true, 'description' => 'The branch name.'],
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

            if (empty($args['branch'])) {
                return ToolResult::error('The branch name is required.');
            }

            $result = $this->service->getBranch($args['organization'], $args['database'], $args['branch']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
