<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new page in a Confluence space.
 */
class ConfluenceCreatePage implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_create_page';
    }

    public function description(): string
    {
        return 'Create a new page in a Confluence space. Requires space_key, title, and body (HTML). Optionally specify a parent page ID.';
    }

    public function parameters(): array
    {
        return [
            'space_key' => ['type' => 'string', 'required' => true, 'description' => 'The space key (e.g. "DEV").'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the page.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The page body in Confluence storage format (HTML). Example: "<p>Hello world</p>".'],
            'parent_id' => ['type' => 'string', 'description' => 'Optional parent page ID to nest the new page under.'],
            'type' => ['type' => 'string', 'description' => 'Content type. Default: "page".'],
        ];
    }

    /**
     * Create a Confluence page with space key, title, body, and optional parent.
     *
     * @param  array<string, mixed>  $args  Tool arguments (space_key, title, body, parent_id, type)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        $spaceKey = $args['space_key'] ?? '';
        $title = $args['title'] ?? '';
        $body = $args['body'] ?? '';

        if (empty($spaceKey)) {
            return ToolResult::error('Space key is required.');
        }

        if (empty($title)) {
            return ToolResult::error('Page title is required.');
        }

        if (empty($body)) {
            return ToolResult::error('Page body is required.');
        }

        try {
            $parentId = $args['parent_id'] ?? null;
            $type = $args['type'] ?? 'page';

            $result = $this->service->createPage($spaceKey, $title, $body, $parentId, $type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
