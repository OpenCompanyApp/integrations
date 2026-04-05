<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Confluence page.
 */
class ConfluenceGetPage implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_get_page';
    }

    public function description(): string
    {
        return 'Get details for a specific Confluence page by ID. Returns title, body, version, space, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The content ID of the page.'],
            'expand' => ['type' => 'string', 'description' => 'Comma-separated list of properties to expand. Example: "body.storage,version,space,ancestors".'],
        ];
    }

    /**
     * Retrieve a Confluence page by its ID with optional property expansion.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id, expand)
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
            $expand = $args['expand'] ?? null;
            $result = $this->service->getPage($pageId, $expand);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
