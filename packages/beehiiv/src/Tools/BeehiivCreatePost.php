<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new post in a Beehiiv publication.
 *
 * Supports all post creation fields including title, content, status,
 * subtitle, and audience settings.
 */
class BeehiivCreatePost implements Tool
{
    /**
     * Create a new BeehiivCreatePost tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_create_post';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new post in your Beehiiv publication. Requires title and content. Set status to "draft" to save without publishing, or "confirmed" to publish.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The post title.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The post content in HTML or Markdown.'],
            'status' => ['type' => 'string', 'description' => 'Post status: "draft" or "confirmed". Default: "draft".'],
            'subtitle' => ['type' => 'string', 'description' => 'Optional subtitle for the post.'],
            'audience' => ['type' => 'string', 'description' => 'Audience: "free", "premium", or "all". Default: "free".'],
            'thumbnail_url' => ['type' => 'string', 'description' => 'URL for the post thumbnail image.'],
            'content_tags' => ['type' => 'array', 'description' => 'Array of tag strings for the post.'],
        ];
    }

    /**
     * Execute the tool — create a post in Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $data = [
                'title' => $args['title'],
                'content' => $args['content'],
            ];

            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['subtitle'])) {
                $data['subtitle'] = $args['subtitle'];
            }
            if (isset($args['audience'])) {
                $data['audience'] = $args['audience'];
            }
            if (isset($args['thumbnail_url'])) {
                $data['thumbnail_url'] = $args['thumbnail_url'];
            }
            if (isset($args['content_tags'])) {
                $data['content_tags'] = $args['content_tags'];
            }

            $result = $this->service->createPost($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
