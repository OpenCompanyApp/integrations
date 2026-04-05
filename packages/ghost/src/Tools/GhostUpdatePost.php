<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

class GhostUpdatePost implements Tool
{
    public function __construct(
        private GhostService $service,
    ) {}

    public function name(): string
    {
        return 'ghost_update_post';
    }

    public function description(): string
    {
        return 'Update an existing blog post in Ghost CMS. Provide the post ID and any fields to change (title, content, status, featured flag, tags).';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The post UUID to update.',
            ],
            'title' => [
                'type' => 'string',
                'description' => 'New post title.',
            ],
            'html' => [
                'type' => 'string',
                'description' => 'New post content as HTML.',
            ],
            'status' => [
                'type' => 'string',
                'enum' => ['draft', 'published'],
                'description' => 'Change post status (draft or published).',
            ],
            'featured' => [
                'type' => 'boolean',
                'description' => 'Set or unset the featured flag.',
            ],
            'tags' => [
                'type' => 'array',
                'description' => 'Replace post tags. Array of tag name strings, e.g. ["News", "Engineering"].',
                'items' => ['type' => 'string'],
            ],
            'excerpt' => [
                'type' => 'string',
                'description' => 'New custom excerpt / meta description.',
            ],
            'feature_image' => [
                'type' => 'string',
                'description' => 'New featured/cover image URL.',
            ],
            'updated_at' => [
                'type' => 'string',
                'description' => 'Last known updated_at timestamp for optimistic concurrency control. Prevents overwriting if the post was modified since you last read it.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Ghost integration is not configured. Provide an Admin API key and base URL.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Post ID is required.');
            }

            $data = [];

            if (isset($args['title'])) {
                $data['title'] = $args['title'];
            }
            if (isset($args['html'])) {
                $data['html'] = $args['html'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['featured'])) {
                $data['featured'] = (bool) $args['featured'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = array_map(function ($tag) {
                    return is_string($tag) ? ['name' => $tag] : $tag;
                }, $args['tags']);
            }
            if (isset($args['excerpt'])) {
                $data['excerpt'] = $args['excerpt'];
            }
            if (isset($args['feature_image'])) {
                $data['feature_image'] = $args['feature_image'];
            }
            if (isset($args['updated_at'])) {
                $data['updated_at'] = $args['updated_at'];
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Specify at least one field (title, html, status, featured, tags, etc.).');
            }

            $result = $this->service->updatePost($id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
