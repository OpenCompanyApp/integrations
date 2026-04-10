<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Plane.so page.
 */
class PlaneGetPage implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_get_page';
    }

    public function description(): string
    {
        return <<<'DESC'
Get detailed content of a Plane.so page, including the full HTML description.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The page UUID.'],
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

            $page = $this->service->getPage(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['page_id'],
            );

            return ToolResult::success([
                'id' => $page['id'] ?? null,
                'name' => $page['name'] ?? null,
                'description_html' => $page['description_html'] ?? null,
                'owned_by' => $page['owned_by'] ?? null,
                'is_favorite' => $page['is_favorite'] ?? null,
                'access' => $page['access'] ?? null,
                'created_at' => $page['created_at'] ?? null,
                'updated_at' => $page['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
