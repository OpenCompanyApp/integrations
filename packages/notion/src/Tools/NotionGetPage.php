<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Notion page by its ID.
 */
class NotionGetPage implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_get_page';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Notion page by its ID. Returns the page object with properties,
        including title, icon, cover, parent info, and timestamps.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the page to retrieve.'],
        ];
    }

    /**
     * Retrieve a page by its ID with all properties, title, icon, and timestamps.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id)
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

            $result = $this->service->getPage($pageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
