<?php

namespace OpenCompany\Integrations\Beamer\Tools;

use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new post in Beamer.
 *
 * Requires a title and content. Optionally specify a category ID and
 * a publication date for scheduled posts.
 */
class BeamerCreatePost implements Tool
{
    public function __construct(
        private BeamerService $service,
    ) {}

    public function name(): string
    {
        return 'beamer_create_post';
    }

    public function description(): string
    {
        return 'Create a new changelog post or announcement in Beamer. Provide a title and content (HTML supported). Optionally set a category and scheduled publication date.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The post title.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The post body content. HTML formatting is supported.'],
            'category' => ['type' => 'integer', 'description' => 'The category ID to assign the post to.'],
            'date' => ['type' => 'string', 'description' => 'Publication date in ISO 8601 format (e.g., "2025-06-01T12:00:00Z"). Omit to publish immediately.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beamer integration is not configured.');
            }

            $title = $args['title'];
            $content = $args['content'];
            $category = $args['category'] ?? null;
            $date = $args['date'] ?? null;

            $result = $this->service->createPost($title, $content, $category, $date);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
