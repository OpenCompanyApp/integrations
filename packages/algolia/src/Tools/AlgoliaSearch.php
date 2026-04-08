<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search an Algolia index with query, filters, and pagination.
 *
 * Uses the Algolia search endpoint (DSN replica) for optimal read performance.
 */
class AlgoliaSearch implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_search';
    }

    public function description(): string
    {
        return 'Search an Algolia index. Supports full-text search with filters, faceting, and pagination. Use this to find records matching a query string or filter criteria.';
    }

    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index to search.'],
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The search query string. Use an empty string "" to retrieve all records (with filters).'],
            'filters' => ['type' => 'string', 'description' => 'Filter expression (e.g., "category:electronics AND price<100").'],
            'hitsPerPage' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 1000).'],
            'page' => ['type' => 'integer', 'description' => 'Page number (0-based). Default: 0.'],
            'attributesToRetrieve' => ['type' => 'array', 'description' => 'List of attributes to include in results. Default: ["*"] (all).'],
            'facets' => ['type' => 'array', 'description' => 'List of facet attributes to compute.'],
            'facetFilters' => ['type' => 'array', 'description' => 'Filter by facet values, e.g. [["category:electronics"], ["brand:Apple"]].'],
            'numericFilters' => ['type' => 'array', 'description' => 'Numeric filters, e.g. ["price>50", "price<200"].'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            $indexName = $args['indexName'];
            $body = ['query' => $args['query']];

            $optionalParams = [
                'filters', 'hitsPerPage', 'page', 'attributesToRetrieve',
                'facets', 'facetFilters', 'numericFilters',
            ];

            foreach ($optionalParams as $param) {
                if (isset($args[$param])) {
                    $body[$param] = $args[$param];
                }
            }

            $result = $this->service->search($indexName, $body);

            $hits = $result['hits'] ?? [];
            $nbHits = $result['nbHits'] ?? 0;
            $page = $result['page'] ?? 0;
            $nbPages = $result['nbPages'] ?? 0;

            return ToolResult::success([
                'hits' => $hits,
                'nbHits' => $nbHits,
                'page' => $page,
                'nbPages' => $nbPages,
                'hitsPerPage' => $result['hitsPerPage'] ?? 20,
                'processingTimeMS' => $result['processingTimeMS'] ?? 0,
                'facets' => $result['facets'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
