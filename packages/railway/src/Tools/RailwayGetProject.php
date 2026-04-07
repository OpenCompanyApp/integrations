<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RailwayGetProject implements Tool
{
    public function __construct(
        private RailwayService $service,
    ) {}

    public function name(): string
    {
        return 'railway_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Railway project, including its environments and plugins.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The Railway project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Railway integration is not configured.');
            }

            if (empty($args['project_id'])) {
                return ToolResult::error('The project_id parameter is required.');
            }

            $result = $this->service->getProject($args['project_id']);

            $project = $result['project'] ?? $result;

            $environments = array_map(function (array $edge): array {
                $node = $edge['node'] ?? $edge;

                return [
                    'id' => $node['id'] ?? '',
                    'name' => $node['name'] ?? '',
                    'is_ephemeral' => $node['isEphemeral'] ?? false,
                ];
            }, $project['environments']['edges'] ?? []);

            $plugins = array_map(function (array $edge): array {
                $node = $edge['node'] ?? $edge;

                return [
                    'id' => $node['id'] ?? '',
                    'name' => $node['name'] ?? '',
                ];
            }, $project['plugins']['edges'] ?? []);

            return ToolResult::success([
                'id' => $project['id'] ?? '',
                'name' => $project['name'] ?? '',
                'description' => $project['description'] ?? '',
                'is_public' => $project['isPublic'] ?? false,
                'team' => $project['team']['name'] ?? null,
                'created_at' => $project['createdAt'] ?? null,
                'updated_at' => $project['updatedAt'] ?? null,
                'environment_count' => count($environments),
                'environments' => $environments,
                'plugin_count' => count($plugins),
                'plugins' => $plugins,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
