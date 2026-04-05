<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list comments from a WordPress site via the REST API.
 *
 * Calls GET /wp/v2/comments with optional query parameters for filtering,
 * pagination, and sorting.
 */
class WordPressListComments implements Tool
{
    /**
     * Create a new WordPressListComments tool instance.
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
        return 'wordpress_list_comments';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'List comments from the WordPress site. Supports filtering by post, status, author, and search. Returns comment IDs, content, author info, and dates.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of comments to return per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'post' => ['type' => 'integer', 'description' => 'Post ID to filter comments by.'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter comments by content or author.'],
            'status' => ['type' => 'string', 'description' => 'Comment status filter: approved, hold, spam, trash, or any. Default: approved.'],
            'author' => ['type' => 'integer', 'description' => 'Comment author user ID to filter by.'],
            'order' => ['type' => 'string', 'description' => 'Sort order: asc or desc (default: desc).'],
            'orderby' => ['type' => 'string', 'description' => 'Sort field: date, date_gmt, id, etc. (default: date_gmt).'],
        ];
    }

    /**
     * Execute the tool — list comments from WordPress.
     *
     * @param array $args Tool parameters (see parameters() for available options).
     * @return ToolResult The result containing the list of comments or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured. Provide username and application password.');
            }

            $result = $this->service->listComments($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
