<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing post on a WordPress site via the REST API.
 *
 * Calls PUT /wp/v2/posts/{id} with the provided fields to update.
 */
class WordPressUpdatePost implements Tool
{
    /**
     * Create a new WordPressUpdatePost tool instance.
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
        return 'wordpress_update_post';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'Update an existing WordPress post. Provide the post ID and any fields to change: title, content, status, categories, tags, etc.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The post ID to update.'],
            'title' => ['type' => 'string', 'description' => 'New post title.'],
            'content' => ['type' => 'string', 'description' => 'New post content in HTML format.'],
            'status' => ['type' => 'string', 'description' => 'New post status: draft, publish, pending, private.'],
            'excerpt' => ['type' => 'string', 'description' => 'New post excerpt in HTML format.'],
            'author' => ['type' => 'integer', 'description' => 'New author user ID.'],
            'categories' => ['type' => 'array', 'description' => 'Array of category IDs to assign (replaces existing).'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag IDs to assign (replaces existing).'],
            'featured_media' => ['type' => 'integer', 'description' => 'Featured image (media) ID.'],
            'slug' => ['type' => 'string', 'description' => 'New URL slug for the post.'],
        ];
    }

    /**
     * Execute the tool — update a post on WordPress.
     *
     * @param array $args Tool parameters (must include 'id' and at least one field to update).
     * @return ToolResult The result containing the updated post data or an error message.
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

            // Separate ID from update data
            $data = array_filter($args, fn (string $key) => $key !== 'id', ARRAY_FILTER_USE_KEY);

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Specify at least one field besides "id".');
            }

            $result = $this->service->updatePost((int) $id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
