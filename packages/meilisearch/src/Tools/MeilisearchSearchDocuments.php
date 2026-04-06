<?php

namespace OpenCompany\Integrations\Meilisearch\Tools;

use OpenCompany\Integrations\Meilisearch\MeilisearchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeilisearchSearchDocuments implements Tool
{
    /**
     * Create a new MeilisearchSearchDocuments tool instance.
     */
    public function __construct(
        private MeilisearchService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'meilisearch_search_documents';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Search for documents in a Meilisearch index. Supports full-text search with filters, sorting, and pagination.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'index_uid' => ['type' => 'string', 'required' => true, 'description' => 'The index unique identifier to search in (e.g., "movies").'],
            'q' => ['type' => 'string', 'description' => 'The search query string. Use empty string "" to return all documents.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of documents to return (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of documents to skip for pagination.'],
            'filter' => ['type' => 'string', 'description' => 'Filter expression as a JSON string, e.g., \'[["genre = Comedy"]]\'.'],
            'sort' => ['type' => 'array', 'description' => 'Sort criteria as an array of strings, e.g., ["price:asc"]. Requires a sortable attribute.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Meilisearch integration is not configured.');
            }

            $indexUid = $args['index_uid'] ?? '';
            if (empty($indexUid)) {
                return ToolResult::error('The "index_uid" parameter is required.');
            }

            $params = [];

            if (isset($args['q'])) {
                $params['q'] = $args['q'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            if (isset($args['filter'])) {
                $filter = $args['filter'];
                $params['filter'] = is_string($filter) ? json_decode($filter, true) ?? $filter : $filter;
            }

            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            $result = $this->service->searchDocuments($indexUid, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
