<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Plane.so workspaces the authenticated user belongs to.
 */
class PlaneListWorkspaces implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_workspaces';
    }

    public function description(): string
    {
        return <<<'DESC'
List all Plane.so workspaces the authenticated user belongs to.
Returns workspace slug, name, and owner info. Use the slug to reference workspaces in other tools.
DESC;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plane.so integration is not configured.');
            }

            $workspaces = $this->service->listWorkspaces();

            $results = array_map(fn(array $ws) => [
                'slug' => $ws['slug'] ?? null,
                'name' => $ws['name'] ?? null,
                'id' => $ws['id'] ?? null,
                'owner' => $ws['owner'] ?? null,
            ], $workspaces);

            return ToolResult::success([
                'workspaces' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
