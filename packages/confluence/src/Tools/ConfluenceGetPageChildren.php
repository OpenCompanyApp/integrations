<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the child pages of a Confluence page.
 */
class ConfluenceGetPageChildren implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_get_page_children';
    }

    public function description(): string
    {
        return 'Get the child pages of a Confluence page by its ID. Supports pagination and property expansion.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The content ID of the parent page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results per page. Default: 25.'],
            'start' => ['type' => 'integer', 'description' => 'Start offset for pagination. Default: 0.'],
            'expand' => ['type' => 'string', 'description' => 'Comma-separated list of properties to expand. Example: "body.storage,version,space".'],
        ];
    }

    /**
     * Retrieve child pages for the specified Confluence page.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id, limit, start, expand)
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
            $limit = $args['limit'] ?? null;
            $start = $args['start'] ?? null;
            $expand = $args['expand'] ?? null;

            $result = $this->service->getPageChildren($pageId, $limit, $start, $expand);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
