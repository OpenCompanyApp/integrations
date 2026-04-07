<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RailwayCreateProject implements Tool
{
    public function __construct(
        private RailwayService $service,
    ) {}

    public function name(): string
    {
        return 'railway_create_project';
    }

    public function description(): string
    {
        return 'Create a new Railway project with a name and optional description.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new Railway project.'],
            'description' => ['type' => 'string', 'description' => 'An optional description for the project.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Railway integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The name parameter is required.');
            }

            $description = $args['description'] ?? null;
            $result = $this->service->createProject($args['name'], $description);

            $project = $result['projectCreate']['project'] ?? $result;

            return ToolResult::success([
                'id' => $project['id'] ?? '',
                'name' => $project['name'] ?? '',
                'description' => $project['description'] ?? '',
                'created_at' => $project['createdAt'] ?? null,
                'updated_at' => $project['updatedAt'] ?? null,
                'message' => "Project '{$args['name']}' created successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
