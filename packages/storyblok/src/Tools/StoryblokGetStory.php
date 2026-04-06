<?php

namespace OpenCompany\Integrations\Storyblok\Tools;

use OpenCompany\Integrations\Storyblok\StoryblokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StoryblokGetStory implements Tool
{
    public function __construct(
        private StoryblokService $service,
    ) {}

    public function name(): string
    {
        return 'storyblok_get_story';
    }

    public function description(): string
    {
        return 'Retrieve a single Storyblok story by its numeric ID, including full content.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the story to retrieve.'],
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

            $result = $this->service->getStory((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
