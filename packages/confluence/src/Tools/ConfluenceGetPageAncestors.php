<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the ancestor (parent) pages of a Confluence page.
 */
class ConfluenceGetPageAncestors implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_get_page_ancestors';
    }

    public function description(): string
    {
        return 'Get the ancestor (parent) pages of a Confluence page by its ID. Returns the full ancestor hierarchy.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The content ID of the page.'],
        ];
    }

    /**
     * Retrieve the ancestor pages for the specified Confluence page.
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
            $result = $this->service->getPageAncestors($pageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
