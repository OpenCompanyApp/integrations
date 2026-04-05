<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

class GhostCreatePost implements Tool
{
    public function __construct(
        private GhostService $service,
    ) {}

    public function name(): string
    {
        return 'ghost_create_post';
    }

    public function description(): string
    {
        return 'Create a new blog post in Ghost CMS. Supports setting title, HTML content, status (draft or published), featured flag, tags, and authors.';
    }

    public function parameters(): array
    {
        return [
            'title' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Post title.',
            ],
            'html' => [
                'type' => 'string',
                'description' => 'Post content as HTML.',
            ],
            'status' => [
                'type' => 'string',
                'enum' => ['draft', 'published'],
                'description' => 'Post status. Defaults to "draft" if not specified.',
            ],
            'featured' => [
                'type' => 'boolean',
                'description' => 'Whether the post is featured (default: false).',
            ],
            'tags' => [
                'type' => 'array',
                'description' => 'Array of tag objects or tag name strings, e.g. ["News", {"name": "Engineering"}].',
                'items' => ['type' => 'string'],
            ],
            'authors' => [
                'type' => 'array',
                'description' => 'Array of author objects or author email strings, e.g. ["admin@example.com"].',
                'items' => ['type' => 'string'],
            ],
            'excerpt' => [
                'type' => 'string',
                'description' => 'Custom post excerpt / meta description.',
            ],
            'feature_image' => [
                'type' => 'string',
                'description' => 'URL for the featured/cover image.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Ghost integration is not configured. Provide an Admin API key and base URL.');
            }

            $title = $args['title'] ?? '';
            if (empty($title)) {
                return ToolResult::error('Post title is required.');
            }

            $data = ['title' => $title];

            if (isset($args['html'])) {
                $data['html'] = $args['html'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['featured'])) {
                $data['featured'] = (bool) $args['featured'];
            }
            if (! empty($args['tags'])) {
                $data['tags'] = array_map(function ($tag) {
                    return is_string($tag) ? ['name' => $tag] : $tag;
                }, $args['tags']);
            }
            if (! empty($args['authors'])) {
                $data['authors'] = array_map(function ($author) {
                    return is_string($author) ? ['email' => $author] : $author;
                }, $args['authors']);
            }
            if (isset($args['excerpt'])) {
                $data['excerpt'] = $args['excerpt'];
            }
            if (isset($args['feature_image'])) {
                $data['feature_image'] = $args['feature_image'];
            }

            $result = $this->service->createPost($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
