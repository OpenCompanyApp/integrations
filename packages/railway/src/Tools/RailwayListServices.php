<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RailwayListServices implements Tool
{
    public function __construct(
        private RailwayService $service,
    ) {}

    public function name(): string
    {
        return 'railway_list_services';
    }

    public function description(): string
    {
        return 'List all services in a Railway project. Returns service IDs, names, and repository info.';
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

            $result = $this->service->listServices($args['project_id']);

            $edges = $result['project']['services']['edges'] ?? [];

            $services = array_map(function (array $edge): array {
                $node = $edge['node'] ?? $edge;

                return [
                    'id' => $node['id'] ?? '',
                    'name' => $node['name'] ?? '',
                    'is_forked' => $node['isForked'] ?? false,
                    'repo_name' => $node['repo']['name'] ?? null,
                    'created_at' => $node['createdAt'] ?? null,
                    'updated_at' => $node['updatedAt'] ?? null,
                ];
            }, $edges);

            return ToolResult::success([
                'services' => $services,
                'count' => count($services),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
