<?php

namespace OpenCompany\Integrations\PlanetScale\Tools;

use OpenCompany\Integrations\PlanetScale\PlanetScaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlanetScaleGetDatabase implements Tool
{
    public function __construct(
        private PlanetScaleService $service,
    ) {}

    public function name(): string
    {
        return 'planetscale_get_database';
    }

    public function description(): string
    {
        return 'Get details of a specific PlanetScale database, including its state, region, and branch count.';
    }

    public function parameters(): array
    {
        return [
            'organization' => ['type' => 'string', 'required' => true, 'description' => 'The organization name.'],
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
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

            $result = $this->service->getDatabase($args['organization'], $args['database']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
