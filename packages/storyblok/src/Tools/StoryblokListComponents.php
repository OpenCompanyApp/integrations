<?php

namespace OpenCompany\Integrations\Storyblok\Tools;

use OpenCompany\Integrations\Storyblok\StoryblokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StoryblokListComponents implements Tool
{
    public function __construct(
        private StoryblokService $service,
    ) {}

    public function name(): string
    {
        return 'storyblok_list_components';
    }

    public function description(): string
    {
        return 'List all component schemas defined in the configured Storyblok space. Useful for understanding available content structures.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Storyblok integration is not configured. Please provide an access token and space ID.');
            }

            $result = $this->service->listComponents();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
