<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list pages from a WordPress site via the REST API.
 *
 * Calls GET /wp/v2/pages with optional query parameters for filtering,
 * pagination, and sorting.
 */
class WordPressListPages implements Tool
{
    /**
     * Create a new WordPressListPages tool instance.
     *
     * @param WordPressService $service The WordPress REST API service.
     */
    public function __construct(
        private WordPressService $service,
    ) {}

    /**
     * Get the tool identifier.
     *
     * @return string The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'wordpress_list_pages';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'List pages from the WordPress site. Supports filtering by status, author, search, and parent. Returns page IDs, titles, dates, and statuses.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of pages to return per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter pages by title or content.'],
            'status' => ['type' => 'string', 'description' => 'Page status filter: publish, draft, pending, private, or any. Default: publish.'],
            'author' => ['type' => 'integer', 'description' => 'Author user ID to filter pages by.'],
            'parent' => ['type' => 'integer', 'description' => 'Parent page ID to filter by (for hierarchical pages).'],
            'order' => ['type' => 'string', 'description' => 'Sort order: asc or desc (default: desc).'],
            'orderby' => ['type' => 'string', 'description' => 'Sort field: date, title, author, id, menu_order, etc. (default: date).'],
        ];
    }

    /**
     * Execute the tool — list pages from WordPress.
     *
     * @param array $args Tool parameters (see parameters() for available options).
     * @return ToolResult The result containing the list of pages or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured. Provide username and application password.');
            }

            $result = $this->service->listPages($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
