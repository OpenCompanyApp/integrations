<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Query a Pinecone index for similar vectors.
 *
 * Searches an index by vector embedding and returns the top matching vectors,
 * optionally constrained by metadata filters.
 */
class PineconeQueryVectors implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_query_vectors';
    }

    public function description(): string
    {
        return 'Search for similar vectors in a Pinecone index using a query embedding.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL.'],
            'vector' => ['type' => 'array', 'required' => true, 'description' => 'Query embedding vector values.', 'items' => ['type' => 'number']],
            'top_k' => ['type' => 'integer', 'description' => 'Number of top matches to return (default: 10).'],
            'filter' => ['type' => 'object', 'description' => 'Optional metadata filter expression.'],
            'include_metadata' => ['type' => 'boolean', 'description' => 'Whether to include metadata in matches (default: true).'],
        ];
    }

    /**
     * Query vectors in an index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }
            if (empty($args['index_host'])) {
                return ToolResult::error('Index host is required.');
            }
            if (empty($args['vector']) || !is_array($args['vector'])) {
                return ToolResult::error('Vector array is required.');
            }

            return ToolResult::success($this->service->queryVectors(
                (string) $args['index_host'],
                $args['vector'],
                isset($args['top_k']) ? (int) $args['top_k'] : 10,
                is_array($args['filter'] ?? null) ? $args['filter'] : null,
                array_key_exists('include_metadata', $args) ? (bool) $args['include_metadata'] : true,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
