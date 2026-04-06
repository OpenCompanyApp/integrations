<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\Integrations\HuggingFace\HuggingFaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List and search AI models on the Hugging Face Hub.
 *
 * Supports filtering by search query, author, task, tags, sorting, and pagination.
 */
class HuggingFaceListModels implements Tool
{
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_list_models';
    }

    public function description(): string
    {
        return 'Search and list AI models on the Hugging Face Hub. Filter by text search, author, task (e.g. "text-generation", "image-classification"), tags, and sort by downloads, likes, or recent activity.';
    }

    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search query to filter models by name or description.'],
            'author' => ['type' => 'string', 'description' => 'Filter by organization or user (e.g. "meta-llama", "openai").'],
            'task' => ['type' => 'string', 'description' => 'Filter by pipeline task (e.g. "text-generation", "text-classification", "image-classification", "automatic-speech-recognition").'],
            'tags' => ['type' => 'array', 'description' => 'Filter by tags (e.g. ["pytorch", "safetensors"]).'],
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
            if (isset($args['task'])) {
                $params['pipeline_tag'] = $args['task'];
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

            $result = $this->service->listModels($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
