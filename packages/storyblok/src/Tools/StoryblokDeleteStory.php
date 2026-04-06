<?php

namespace OpenCompany\Integrations\Storyblok\Tools;

use OpenCompany\Integrations\Storyblok\StoryblokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StoryblokDeleteStory implements Tool
{
    public function __construct(
        private StoryblokService $service,
    ) {}

    public function name(): string
    {
        return 'storyblok_delete_story';
    }

    public function description(): string
    {
        return 'Delete a story from the configured Storyblok space by its numeric ID. This action is irreversible.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the story to delete.'],
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

            $this->service->deleteStory((int) $args['id']);

            return ToolResult::success([
                'message' => "Story with ID {$args['id']} has been deleted.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
