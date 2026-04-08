<?php

namespace OpenCompany\Integrations\Elastic\Tools;

use OpenCompany\Integrations\Elastic\ElasticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticSearchDocuments implements Tool
{
    /**
     * @param  ElasticService  $service  The Elasticsearch service instance
     */
    public function __construct(
        private ElasticService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'elastic_search_documents';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Search for documents in an Elasticsearch index. Supports full query DSL including match, term, bool, and aggregation queries.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'index' => ['type' => 'string', 'required' => true, 'description' => 'The index to search in.'],
            'query' => ['type' => 'object', 'description' => 'The Elasticsearch query object. Example: {"match": {"title": "search term"}}. Defaults to match_all if omitted.'],
            'size' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 10).'],
            'from' => ['type' => 'integer', 'description' => 'Starting offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Elasticsearch integration is not configured.');
            }

            $index = $args['index'] ?? '';
            if (empty($index)) {
                return ToolResult::error('The "index" parameter is required.');
            }

            $body = [];

            // Build query — default to match_all if no query provided
            if (isset($args['query'])) {
                $query = $args['query'];
                if (is_string($query)) {
                    $query = json_decode($query, true);
                }
                $body['query'] = $query;
            } else {
                $body['query'] = ['match_all' => new \stdClass()];
            }

            if (isset($args['size'])) {
                $body['size'] = (int) $args['size'];
            }

            if (isset($args['from'])) {
                $body['from'] = (int) $args['from'];
            }

            $result = $this->service->searchDocuments($index, $body);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the search response to a cleaner structure.
     *
     * @param  array<string, mixed>  $result  The raw Elasticsearch response
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $hits = $result['hits'] ?? [];
        $total = $hits['total'] ?? ['value' => 0, 'relation' => 'eq'];

        $documents = array_map(function (array $hit): array {
            $doc = [
                '_id' => $hit['_id'] ?? null,
                '_index' => $hit['_index'] ?? null,
                '_score' => $hit['_score'] ?? null,
            ];

            if (isset($hit['_source'])) {
                $doc['_source'] = $hit['_source'];
            }

            return $doc;
        }, $hits['hits'] ?? []);

        return [
            'total' => $total['value'] ?? 0,
            'relation' => $total['relation'] ?? 'eq',
            'count' => count($documents),
            'documents' => $documents,
        ];
    }
}
