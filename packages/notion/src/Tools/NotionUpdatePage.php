<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update properties on a Notion page, including archiving and unarchiving.
 */
class NotionUpdatePage implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_update_page';
    }

    public function description(): string
    {
        return <<<'MD'
        Update properties on a Notion page. Provide properties as a JSON object
        matching the database/page schema. Can also archive/unarchive the page.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the page to update.'],
            'properties' => ['type' => 'string', 'description' => 'Properties to update as a JSON object.'],
            'archived' => ['type' => 'boolean', 'description' => 'Whether to archive the page.'],
        ];
    }

    /**
     * Update page properties and/or archive status.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id, properties, archived)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $pageId = $args['page_id'] ?? '';

            if (empty($pageId)) {
                return ToolResult::error('page_id is required.');
            }

            $body = [];

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

            if (isset($args['archived'])) {
                $body['archived'] = (bool) $args['archived'];
            }

            $result = $this->service->updatePage($pageId, $body);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'url' => $result['url'] ?? '',
                'archived' => $result['archived'] ?? false,
                'last_edited_time' => $result['last_edited_time'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
