<?php

namespace OpenCompany\Integrations\Huggingface\Tools;

use OpenCompany\Integrations\Huggingface\HuggingfaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List and search datasets on the Hugging Face Hub.
 *
 * Supports filtering by search query, author, tags, sorting, and pagination.
 */
class HuggingfaceListDatasets implements Tool
{
    public function __construct(
        private HuggingfaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_list_datasets';
    }

    public function description(): string
    {
        return 'Search and list datasets on the Hugging Face Hub. Filter by text search, author, tags, and sort by downloads, likes, or recent activity.';
    }

    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search query to filter datasets by name or description.'],
            'author' => ['type' => 'string', 'description' => 'Filter by organization or user (e.g. "HuggingFaceFW", "mozilla-foundation").'],
            'tags' => ['type' => 'array', 'description' => 'Filter by tags (e.g. ["text-classification", "english"]).'],
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

            $result = $this->service->listDatasets($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
