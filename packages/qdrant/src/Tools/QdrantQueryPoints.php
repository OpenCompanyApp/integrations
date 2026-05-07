<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Query points using Qdrant's modern Query API.
 */
class QdrantQueryPoints implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_query_points';
    }

    public function description(): string
    {
        return 'Use Qdrant Query API for nearest, recommend, discover, fusion, or multi-stage vector queries.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'query' => ['type' => 'object', 'description' => 'Query object or vector.'],
            'using' => ['type' => 'string', 'description' => 'Named vector to query.'],
            'filter' => ['type' => 'object', 'description' => 'Qdrant filter object.'],
            'params' => ['type' => 'object', 'description' => 'Search params.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
            'with_payload' => ['type' => 'boolean', 'description' => 'Include payloads.'],
            'with_vector' => ['type' => 'boolean', 'description' => 'Include vectors.'],
            'score_threshold' => ['type' => 'number', 'description' => 'Minimum score threshold.'],
        ];
    }

    /**
     * Execute a Query API request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            $collection = (string) ($args['collection'] ?? '');
            unset($args['collection']);

            return ToolResult::success($this->service->queryPoints($collection, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
