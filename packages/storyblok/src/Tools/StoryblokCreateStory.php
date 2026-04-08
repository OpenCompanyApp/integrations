<?php

namespace OpenCompany\Integrations\Storyblok\Tools;

use OpenCompany\Integrations\Storyblok\StoryblokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StoryblokCreateStory implements Tool
{
    public function __construct(
        private StoryblokService $service,
    ) {}

    public function name(): string
    {
        return 'storyblok_create_story';
    }

    public function description(): string
    {
        return 'Create a new story in the configured Storyblok space. Requires a name, slug, and content object.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The display name of the story.'],
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'URL-friendly slug for the story (e.g., "my-new-page").'],
            'content' => ['type' => 'object', 'required' => true, 'description' => 'The story content as a JSON object. Must match a component schema in the space (e.g., {"component": "page", "title": "Hello"}).'],
            'parent_id' => ['type' => 'integer', 'description' => 'The numeric ID of the parent story (for nested stories).'],
            'is_startpage' => ['type' => 'boolean', 'description' => 'Whether this is the root/start page of the space (default: false).'],
            'tag_list' => ['type' => 'array', 'description' => 'List of tags to assign to the story.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Storyblok integration is not configured. Please provide an access token and space ID.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The "name" parameter is required.');
            }

            if (empty($args['slug'])) {
                return ToolResult::error('The "slug" parameter is required.');
            }

            if (empty($args['content']) || !is_array($args['content'])) {
                return ToolResult::error('The "content" parameter is required and must be an object.');
            }

            $data = [
                'name' => $args['name'],
                'slug' => $args['slug'],
                'content' => $args['content'],
            ];

            if (isset($args['parent_id'])) {
                $data['parent_id'] = (int) $args['parent_id'];
            }

            if (isset($args['is_startpage'])) {
                $data['is_startpage'] = (bool) $args['is_startpage'];
            }

            if (isset($args['tag_list'])) {
                $data['tag_list'] = $args['tag_list'];
            }

            $result = $this->service->createStory($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
