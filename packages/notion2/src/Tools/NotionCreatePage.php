<?php

namespace OpenCompany\Integrations\Notion2\Tools;

use OpenCompany\Integrations\Notion2\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NotionCreatePage implements Tool
{
    public function __construct(private NotionService $service) {}

    public function name(): string { return 'notion2_create_page'; }
    public function description(): string { return 'Create a new page in Notion.'; }

    public function parameters(): array
    {
        return [
            'parent'   => ['type' => 'object',  'required' => true,  'description' => 'Parent object, e.g. {"page_id":"..."} or {"database_id":"..."}.'],
            'properties' => ['type' => 'object', 'description' => 'Page property values (title, etc.).'],
            'children' => ['type' => 'array',   'description' => 'Array of block objects to append as page content.'],
            'icon'     => ['type' => 'object',  'description' => 'Icon for the page (emoji or external).'],
            'cover'    => ['type' => 'object',  'description' => 'Cover image for the page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Notion integration is not configured.'); }
            $parent = $args['parent'] ?? [];
            if (empty($parent)) { return ToolResult::error('parent is required.'); }
            $data = ['parent' => $parent];
            if (isset($args['properties'])) { $data['properties'] = $args['properties']; }
            if (isset($args['children'])) { $data['children'] = $args['children']; }
            if (isset($args['icon'])) { $data['icon'] = $args['icon']; }
            if (isset($args['cover'])) { $data['cover'] = $args['cover']; }
            $page = $this->service->createPage($data);
            return ToolResult::success($page);
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }
}
