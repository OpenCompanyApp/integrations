<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list posts from a WordPress site via the REST API.
 *
 * Calls GET /wp/v2/posts with optional query parameters for filtering,
 * pagination, and sorting.
 */
class WordPressListPosts implements Tool
{
    /**
     * Create a new WordPressListPosts tool instance.
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
        return 'wordpress_list_posts';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'List posts from the WordPress site. Supports filtering by status, author, category, tag, and search. Returns post IDs, titles, dates, and statuses.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of posts to return per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter posts by title or content.'],
            'status' => ['type' => 'string', 'description' => 'Post status filter: publish, draft, pending, private, trash, or any. Default: publish.'],
            'author' => ['type' => 'integer', 'description' => 'Author user ID to filter posts by.'],
            'categories' => ['type' => 'string', 'description' => 'Comma-separated category IDs to filter by.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated tag IDs to filter by.'],
            'order' => ['type' => 'string', 'description' => 'Sort order: asc or desc (default: desc).'],
            'orderby' => ['type' => 'string', 'description' => 'Sort field: date, title, author, id, etc. (default: date).'],
        ];
    }

    /**
     * Execute the tool — list posts from WordPress.
     *
     * @param array $args Tool parameters (see parameters() for available options).
     * @return ToolResult The result containing the list of posts or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured. Provide username and application password.');
            }

            $result = $this->service->listPosts($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
