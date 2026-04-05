<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new page in Notion as a child of a database or another page.
 */
class NotionCreatePage implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_create_page';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new page in Notion. The page can be created as a child of a database
        (to create a row) or as a child of another page (to create a sub-page).
        Provide properties as a JSON object matching the database schema when using a database parent.
        Provide children (block content) as a JSON array of block objects.
        MD;
    }

    public function parameters(): array
    {
        return [
            'parent_type' => ['type' => 'string', 'required' => true, 'description' => 'Parent type: "database" or "page".'],
            'parent_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the parent database or page.'],
            'properties' => ['type' => 'string', 'description' => 'Page properties as a JSON object. For database parents, keys should match database property names.'],
            'children' => ['type' => 'string', 'description' => 'Page content as a JSON array of block objects.'],
        ];
    }

    /**
     * Create a page under a database or parent page with optional properties and content blocks.
     *
     * @param  array<string, mixed>  $args  Tool arguments (parent_type, parent_id, properties, children)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $parentType = $args['parent_type'] ?? '';
            $parentId = $args['parent_id'] ?? '';

            if (empty($parentType) || ! in_array($parentType, ['database', 'page'])) {
                return ToolResult::error('parent_type must be "database" or "page".');
            }

            if (empty($parentId)) {
                return ToolResult::error('parent_id is required.');
            }

            $body = [
                'parent' => [
                    $parentType . '_id' => $parentId,
                ],
            ];

            if (isset($args['properties'])) {
                $props = $args['properties'];
                if (is_string($props)) {
                    $decoded = json_decode($props, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in properties: ' . json_last_error_msg());
                    }
                    $props = $decoded;
                }
                $body['properties'] = $props;
            } elseif ($parentType === 'page') {
                // Default title for sub-pages
                $body['properties'] = [
                    'title' => [['text' => ['content' => 'New Page']]],
                ];
            }

            if (isset($args['children'])) {
                $children = $args['children'];
                if (is_string($children)) {
                    $decoded = json_decode($children, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in children: ' . json_last_error_msg());
                    }
                    $children = $decoded;
                }
                $body['children'] = $children;
            }

            $result = $this->service->createPage($body);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'url' => $result['url'] ?? '',
                'created_time' => $result['created_time'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
