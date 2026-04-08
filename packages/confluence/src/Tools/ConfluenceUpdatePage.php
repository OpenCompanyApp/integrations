<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Confluence page.
 */
class ConfluenceUpdatePage implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_update_page';
    }

    public function description(): string
    {
        return 'Update an existing Confluence page. Requires page_id, title, body, and the new version number (current version + 1).';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The content ID of the page to update.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The updated title of the page.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The updated page body in Confluence storage format (HTML).'],
            'version' => ['type' => 'integer', 'required' => true, 'description' => 'The new version number (must be current version + 1).'],
            'status' => ['type' => 'string', 'description' => 'Optional status. Example: "current" or "draft".'],
        ];
    }

    /**
     * Update a Confluence page with new title, body, and incremented version.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id, title, body, version, status)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        $pageId = $args['page_id'] ?? '';
        $title = $args['title'] ?? '';
        $body = $args['body'] ?? '';
        $version = $args['version'] ?? null;

        if (empty($pageId)) {
            return ToolResult::error('Page ID is required.');
        }

        if (empty($title)) {
            return ToolResult::error('Page title is required.');
        }

        if (empty($body)) {
            return ToolResult::error('Page body is required.');
        }

        if ($version === null) {
            return ToolResult::error('Version number is required (must be current version + 1).');
        }

        try {
            $status = $args['status'] ?? null;
            $result = $this->service->updatePage($pageId, $title, $body, (int) $version, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
