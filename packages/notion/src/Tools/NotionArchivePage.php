<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Archive a Notion page by setting its archived flag to true.
 */
class NotionArchivePage implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_archive_page';
    }

    public function description(): string
    {
        return <<<'MD'
        Archive a Notion page by setting its archived flag to true.
        The page can be restored by using notion_update_page with archived=false.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the page to archive.'],
        ];
    }

    /**
     * Archive a page by setting its archived flag to true.
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

            $result = $this->service->updatePage($pageId, ['archived' => true]);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'archived' => $result['archived'] ?? true,
                'last_edited_time' => $result['last_edited_time'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
