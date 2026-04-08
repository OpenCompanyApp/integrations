<?php

namespace OpenCompany\Integrations\Neon\Tools;

use OpenCompany\Integrations\Neon\NeonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NeonCreateProject implements Tool
{
    public function __construct(
        private NeonService $service,
    ) {}

    public function name(): string
    {
        return 'neon_create_project';
    }

    public function description(): string
    {
        return 'Create a new Neon project. Requires a name. Optionally specify a region and Postgres version.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The project name (e.g., "my-app-prod").'],
            'region_id' => ['type' => 'string', 'description' => 'Region where the project will be created (e.g., "aws-us-east-2", "aws-eu-west-1").'],
            'pg_version' => ['type' => 'integer', 'description' => 'Postgres version (e.g., 16).'],
            'branch_name' => ['type' => 'string', 'description' => 'Name for the initial branch (default: "main").'],
            'database_name' => ['type' => 'string', 'description' => 'Name for the initial database (default: "neondb").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Neon integration is not configured.');
            }

            $project = [
                'name' => $args['name'],
            ];

            if (isset($args['region_id'])) {
                $project['region_id'] = $args['region_id'];
            }

            if (isset($args['pg_version'])) {
                $project['pg_version'] = $args['pg_version'];
            }

            $params = ['project' => $project];

            if (isset($args['branch_name']) || isset($args['database_name'])) {
                $params['branch'] = [];
                if (isset($args['branch_name'])) {
                    $params['branch']['name'] = $args['branch_name'];
                }
                if (isset($args['database_name'])) {
                    $params['branch']['database_name'] = $args['database_name'];
                }
            }

            $result = $this->service->createProject($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
