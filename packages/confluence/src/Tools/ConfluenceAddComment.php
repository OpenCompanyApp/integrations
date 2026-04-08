<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment to a Confluence page.
 */
class ConfluenceAddComment implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_add_comment';
    }

    public function description(): string
    {
        return 'Add a comment to a Confluence page. Requires the page ID and comment body in HTML.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The content ID of the page to comment on.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The comment body in Confluence storage format (HTML). Example: "<p>Great article!</p>".'],
        ];
    }

    /**
     * Add a comment to the specified Confluence page.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id, body)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        $pageId = $args['page_id'] ?? '';
        $body = $args['body'] ?? '';

        if (empty($pageId)) {
            return ToolResult::error('Page ID is required.');
        }

        if (empty($body)) {
            return ToolResult::error('Comment body is required.');
        }

        try {
            $result = $this->service->addComment($pageId, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
