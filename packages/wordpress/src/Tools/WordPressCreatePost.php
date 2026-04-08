<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new post on a WordPress site via the REST API.
 *
 * Calls POST /wp/v2/posts with the provided post data.
 */
class WordPressCreatePost implements Tool
{
    /**
     * Create a new WordPressCreatePost tool instance.
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
        return 'wordpress_create_post';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'Create a new post on the WordPress site. Requires a title. Content, status, categories, and tags can be specified. Defaults to draft status for safety.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The post title.'],
            'content' => ['type' => 'string', 'description' => 'The post content in HTML format.'],
            'status' => ['type' => 'string', 'description' => 'Post status: draft, publish, pending, private. Default: draft.'],
            'excerpt' => ['type' => 'string', 'description' => 'The post excerpt in HTML format.'],
            'author' => ['type' => 'integer', 'description' => 'Author user ID. Defaults to the authenticated user.'],
            'categories' => ['type' => 'array', 'description' => 'Array of category IDs to assign.'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag IDs to assign.'],
            'featured_media' => ['type' => 'integer', 'description' => 'Featured image (media) ID.'],
            'slug' => ['type' => 'string', 'description' => 'URL slug for the post. Auto-generated from title if omitted.'],
        ];
    }

    /**
     * Execute the tool — create a new post on WordPress.
     *
     * @param array $args Tool parameters (must include 'title').
     * @return ToolResult The result containing the created post data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured. Provide username and application password.');
            }

            $title = $args['title'] ?? '';
            if (empty($title)) {
                return ToolResult::error('The "title" parameter is required.');
            }

            // Default to draft for safety — agents must explicitly request publish
            if (!isset($args['status'])) {
                $args['status'] = 'draft';
            }

            $result = $this->service->createPost($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
