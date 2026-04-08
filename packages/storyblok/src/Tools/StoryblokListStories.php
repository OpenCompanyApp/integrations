<?php

namespace OpenCompany\Integrations\Storyblok\Tools;

use OpenCompany\Integrations\Storyblok\StoryblokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StoryblokListStories implements Tool
{
    public function __construct(
        private StoryblokService $service,
    ) {}

    public function name(): string
    {
        return 'storyblok_list_stories';
    }

    public function description(): string
    {
        return 'List stories in the configured Storyblok space. Supports pagination, search, and sorting.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of stories per page (default: 25, max: 100).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter stories by name or slug.'],
            'sort_by' => ['type' => 'string', 'description' => 'Sort field (e.g., "name:asc", "created_at:desc", "updated_at:desc").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Storyblok integration is not configured. Please provide an access token and space ID.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['per_page'])) {
                $params['per_page'] = min((int) $args['per_page'], 100);
            }

            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }

            if (isset($args['sort_by'])) {
                $params['sort_by'] = $args['sort_by'];
            }

            $result = $this->service->listStories($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
