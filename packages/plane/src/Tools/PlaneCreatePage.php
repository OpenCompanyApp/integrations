<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new page in a Plane.so project.
 */
class PlaneCreatePage implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_page';
    }

    public function description(): string
    {
        return <<<'DESC'
Create a new page in a Plane.so project. Pages are Notion-like documents for notes, specs, and documentation.
Requires a name. Optionally set HTML content.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Page title.'],
            'description_html' => ['type' => 'string', 'description' => 'Page content in HTML format.'],
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

            $data = ['name' => $args['name']];

            if (isset($args['description_html']) && $args['description_html'] !== '') {
                $data['description_html'] = $args['description_html'];
            }

            $page = $this->service->createPage($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id'], $data);

            return ToolResult::success([
                'id' => $page['id'] ?? null,
                'name' => $page['name'] ?? null,
                'created_at' => $page['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
