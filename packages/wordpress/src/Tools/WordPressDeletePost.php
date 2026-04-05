<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Delete Post
 *
 * Deletes a blog post by ID via the WordPress REST API.
 */
class WordPressDeletePost implements Tool
{
    /**
     * Create a new WordPressDeletePost tool instance.
     */
    public function __construct(
        private WordPressService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'wordpress_delete_post';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Delete a WordPress blog post by its ID. This action is irreversible.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The post ID to delete.'],
        ];
    }

    /**
     * Execute the delete post tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured.');
            }

            $id = (int) $args['id'];
            $this->service->deletePost($id);

            return ToolResult::success("Post {$id} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
