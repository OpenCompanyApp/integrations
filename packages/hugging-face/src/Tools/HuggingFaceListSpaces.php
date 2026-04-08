<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\Integrations\HuggingFace\HuggingFaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List and search Hugging Face Spaces.
 *
 * Supports filtering by search query, author, tags, sorting, and pagination.
 */
class HuggingFaceListSpaces implements Tool
{
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_list_spaces';
    }

    public function description(): string
    {
        return 'Search and list Spaces on the Hugging Face Hub. Filter by text search, author, tags, SDK, and sort by downloads, likes, or recent activity.';
    }

    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search query to filter Spaces by name or description.'],
            'author' => ['type' => 'string', 'description' => 'Filter by organization or user (e.g. "gradio", "stabilityai").'],
            'tags' => ['type' => 'array', 'description' => 'Filter by tags (e.g. ["gradio", "text-generation"]).'],
            'sort' => ['type' => 'string', 'description' => 'Sort order: "downloads", "likes", "lastModified", "created". Defaults to "downloads".'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc". Defaults to "desc".'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            $params = [];

            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }
            if (isset($args['author'])) {
                $params['author'] = $args['author'];
            }
            if (isset($args['tags'])) {
                $params['tags'] = $args['tags'];
            }
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }
            if (isset($args['direction'])) {
                $params['direction'] = $args['direction'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listSpaces($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
