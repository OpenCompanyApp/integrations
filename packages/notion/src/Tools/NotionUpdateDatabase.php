<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Notion database's title and/or property schema.
 */
class NotionUpdateDatabase implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_update_database';
    }

    public function description(): string
    {
        return <<<'MD'
        Update a Notion database's title and/or property schema.
        Provide a new title and/or modified properties as a JSON object.
        MD;
    }

    public function parameters(): array
    {
        return [
            'database_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the database to update.'],
            'title' => ['type' => 'string', 'description' => 'New title for the database.'],
            'properties' => ['type' => 'string', 'description' => 'Updated property schema as a JSON object. Only included properties will be updated.'],
        ];
    }

    /**
     * Update a database's title and/or property schema.
     *
     * @param  array<string, mixed>  $args  Tool arguments (database_id, title, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $databaseId = $args['database_id'] ?? '';

            if (empty($databaseId)) {
                return ToolResult::error('database_id is required.');
            }

            $body = [];

            if (isset($args['title'])) {
                $body['title'] = [['text' => ['content' => $args['title']]]];
            }

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
            }

            $result = $this->service->updateDatabase($databaseId, $body);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'url' => $result['url'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
