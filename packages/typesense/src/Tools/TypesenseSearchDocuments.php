<?php

namespace OpenCompany\Integrations\Typesense\Tools;

use OpenCompany\Integrations\Typesense\TypesenseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypesenseSearchDocuments implements Tool
{
    public function __construct(
        private TypesenseService $service,
    ) {}

    public function name(): string
    {
        return 'typesense_search_documents';
    }

    public function description(): string
    {
        return 'Search for documents in a Typesense collection. Supports full-text search, filtering, sorting, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to search in.'],
            'q' => ['type' => 'string', 'required' => true, 'description' => 'The search query string. Use "*" to match all documents.'],
            'query_by' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of fields to search in (e.g., "title,description").'],
            'filter_by' => ['type' => 'string', 'description' => 'Filter conditions (e.g., "category:electronics AND price:<100").'],
            'sort_by' => ['type' => 'string', 'description' => 'Sort criteria (e.g., "price:asc", "created_at:desc").'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 10, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typesense integration is not configured.');
            }

            $collection = $args['collection'] ?? '';
            if (empty($collection)) {
                return ToolResult::error('The "collection" parameter is required.');
            }

            $q = $args['q'] ?? '';
            if ($q === '') {
                return ToolResult::error('The "q" parameter is required.');
            }

            $queryBy = $args['query_by'] ?? '';
            if (empty($queryBy)) {
                return ToolResult::error('The "query_by" parameter is required.');
            }

            $params = [
                'q' => $q,
                'query_by' => $queryBy,
            ];

            if (isset($args['filter_by']) && $args['filter_by'] !== '') {
                $params['filter_by'] = $args['filter_by'];
            }
            if (isset($args['sort_by']) && $args['sort_by'] !== '') {
                $params['sort_by'] = $args['sort_by'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->searchDocuments($collection, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
