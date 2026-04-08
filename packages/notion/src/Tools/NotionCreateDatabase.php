<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new database as a child of a Notion page.
 */
class NotionCreateDatabase implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_create_database';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new database as a child of a page. Provide the parent page ID,
        a title, and a properties schema. Properties define the columns of the database.
        Example properties: {"Name": {"title": {}}, "Status": {"select": {"options": [{"name": "Todo"}, {"name": "Done"}]}}}.
        MD;
    }

    public function parameters(): array
    {
        return [
            'parent_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the parent page where the database will be created.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Title of the database.'],
            'properties' => ['type' => 'string', 'required' => true, 'description' => 'Database property schema as a JSON object. Each key is a property name with its type config.'],
        ];
    }

    /**
     * Create a database under a parent page with the given title and property schema.
     *
     * @param  array<string, mixed>  $args  Tool arguments (parent_id, title, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $parentId = $args['parent_id'] ?? '';
            $title = $args['title'] ?? '';

            if (empty($parentId)) {
                return ToolResult::error('parent_id is required.');
            }

            if (empty($title)) {
                return ToolResult::error('title is required.');
            }

            $props = $args['properties'] ?? '';
            if (is_string($props)) {
                $decoded = json_decode($props, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in properties: ' . json_last_error_msg());
                }
                $props = $decoded;
            }

            if (empty($props)) {
                return ToolResult::error('properties schema is required.');
            }

            $body = [
                'parent' => ['page_id' => $parentId],
                'title' => [['text' => ['content' => $title]]],
                'properties' => $props,
            ];

            $result = $this->service->createDatabase($body);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'url' => $result['url'] ?? '',
                'title' => $title,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
