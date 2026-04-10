<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pages in a Plane.so project.
 */
class PlaneListPages implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_pages';
    }

    public function description(): string
    {
        return <<<'DESC'
List all pages in a Plane.so project. Pages are Notion-like documents for notes, specs, and documentation.
Returns page ID, name, description, and ownership info.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
        ];
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

            $pages = $this->service->listPages($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id']);

            $results = array_map(fn(array $page) => [
                'id' => $page['id'] ?? null,
                'name' => $page['name'] ?? null,
                'description_html' => $page['description_html'] ?? null,
                'owned_by' => $page['owned_by'] ?? null,
                'is_favorite' => $page['is_favorite'] ?? null,
                'created_at' => $page['created_at'] ?? null,
                'updated_at' => $page['updated_at'] ?? null,
            ], $pages);

            return ToolResult::success([
                'pages' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
