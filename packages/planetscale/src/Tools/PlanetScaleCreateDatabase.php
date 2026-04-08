<?php

namespace OpenCompany\Integrations\PlanetScale\Tools;

use OpenCompany\Integrations\PlanetScale\PlanetScaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlanetScaleCreateDatabase implements Tool
{
    public function __construct(
        private PlanetScaleService $service,
    ) {}

    public function name(): string
    {
        return 'planetscale_create_database';
    }

    public function description(): string
    {
        return 'Create a new database in a PlanetScale organization. Specify the database name and optionally a region and notes.';
    }

    public function parameters(): array
    {
        return [
            'organization' => ['type' => 'string', 'required' => true, 'description' => 'The organization name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The database name (lowercase, hyphens allowed).'],
            'region' => ['type' => 'string', 'description' => 'The region slug (e.g., "us-east-1"). Defaults to the organization region.'],
            'notes' => ['type' => 'string', 'description' => 'Optional notes about the database.'],
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

            if (empty($args['name'])) {
                return ToolResult::error('The database name is required.');
            }

            $options = [];
            if (!empty($args['region'])) {
                $options['region'] = $args['region'];
            }
            if (!empty($args['notes'])) {
                $options['notes'] = $args['notes'];
            }

            $result = $this->service->createDatabase($args['organization'], $args['name'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
