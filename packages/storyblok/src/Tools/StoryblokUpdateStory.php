<?php

namespace OpenCompany\Integrations\Storyblok\Tools;

use OpenCompany\Integrations\Storyblok\StoryblokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StoryblokUpdateStory implements Tool
{
    public function __construct(
        private StoryblokService $service,
    ) {}

    public function name(): string
    {
        return 'storyblok_update_story';
    }

    public function description(): string
    {
        return 'Update an existing Storyblok story. Provide the story ID and the fields to update (e.g., content, name, slug).';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the story to update.'],
            'content' => ['type' => 'object', 'description' => 'Updated story content as a JSON object.'],
            'name' => ['type' => 'string', 'description' => 'Updated display name of the story.'],
            'slug' => ['type' => 'string', 'description' => 'Updated URL slug for the story.'],
            'tag_list' => ['type' => 'array', 'description' => 'Updated list of tags.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Storyblok integration is not configured. Please provide an access token and space ID.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $data = [];

            if (isset($args['content']) && is_array($args['content'])) {
                $data['content'] = $args['content'];
            }

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }

            if (isset($args['slug'])) {
                $data['slug'] = $args['slug'];
            }

            if (isset($args['tag_list'])) {
                $data['tag_list'] = $args['tag_list'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update must be provided (content, name, slug, or tag_list).');
            }

            $result = $this->service->updateStory((int) $args['id'], $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
