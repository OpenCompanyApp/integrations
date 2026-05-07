<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Railway projects visible to the authenticated account.
 *
 * Returns normalized project metadata with team context.
 */
class RailwayListProjects implements Tool
{
    /**
     * @param  RailwayService  $service  The Railway GraphQL API client.
     */
    public function __construct(
        private RailwayService $service,
    ) {}

    public function name(): string
    {
        return 'railway_list_projects';
    }

    public function description(): string
    {
        return 'List all Railway projects the authenticated user has access to. Returns project IDs, names, descriptions, and team info.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Return normalized projects for the authenticated Railway account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Railway integration is not configured.');
            }

            $result = $this->service->listProjects();

            $edges = $result['viewer']['projects']['edges'] ?? [];

            $projects = array_map(function (array $edge): array {
                $node = $edge['node'] ?? $edge;

                return [
                    'id' => $node['id'] ?? '',
                    'name' => $node['name'] ?? '',
                    'description' => $node['description'] ?? '',
                    'is_public' => $node['isPublic'] ?? false,
                    'team' => $node['team']['name'] ?? null,
                    'created_at' => $node['createdAt'] ?? null,
                    'updated_at' => $node['updatedAt'] ?? null,
                ];
            }, $edges);

            return ToolResult::success([
                'projects' => $projects,
                'count' => count($projects),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
