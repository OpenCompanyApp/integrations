<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Railway services for a project.
 *
 * Returns service identifiers, names, and repository summaries.
 */
class RailwayListServices implements Tool
{
    /**
     * @param  RailwayService  $service  The Railway GraphQL API client.
     */
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

    /**
     * List project services and return normalized service records.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id)
     */
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
