<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single post by ID from a WordPress site via the REST API.
 *
 * Calls GET /wp/v2/posts/{id} and returns the full post object.
 */
class WordPressGetPost implements Tool
{
    /**
     * Create a new WordPressGetPost tool instance.
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
        return 'wordpress_get_post';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'Get a single WordPress post by its ID. Returns the full post object including title, content, excerpt, author, categories, tags, and metadata.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The post ID to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get a single post from WordPress.
     *
     * @param array $args Tool parameters (must include 'id').
     * @return ToolResult The result containing the post data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured. Provide username and application password.');
            }

            $id = $args['id'] ?? null;
            if ($id === null) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getPost((int) $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
