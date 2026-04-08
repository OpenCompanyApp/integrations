<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list users from a WordPress site via the REST API.
 *
 * Calls GET /wp/v2/users with optional query parameters for filtering and search.
 */
class WordPressListUsers implements Tool
{
    /**
     * Create a new WordPressListUsers tool instance.
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
        return 'wordpress_list_users';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'List users registered on the WordPress site. Supports filtering by role and search. Returns user IDs, names, and email addresses.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of users to return per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter users by name, email, or slug.'],
            'roles' => ['type' => 'string', 'description' => 'Comma-separated roles to filter by (e.g. administrator, editor, author).'],
            'order' => ['type' => 'string', 'description' => 'Sort order: asc or desc (default: asc).'],
            'orderby' => ['type' => 'string', 'description' => 'Sort field: name, id, registered_date, etc. (default: name).'],
        ];
    }

    /**
     * Execute the tool — list users from WordPress.
     *
     * @param array $args Tool parameters (see parameters() for available options).
     * @return ToolResult The result containing the list of users or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured. Provide username and application password.');
            }

            $result = $this->service->listUsers($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
