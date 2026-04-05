<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Confluence page.
 */
class ConfluenceDeletePage implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_delete_page';
    }

    public function description(): string
    {
        return 'Delete a Confluence page by its ID. This action moves the page to the trash.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The content ID of the page to delete.'],
        ];
    }

    /**
     * Delete the specified Confluence page.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        $pageId = $args['page_id'] ?? '';

        if (empty($pageId)) {
            return ToolResult::error('Page ID is required.');
        }

        try {
            $result = $this->service->deletePage($pageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
