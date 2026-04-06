<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Query a Pinecone index for similar vectors.
 *
 * Searches the index using a query vector and returns the top-k most
 * similar results. Supports metadata filtering and optional inclusion
 * of vector metadata in the response.
 */
class PineconeQueryVectors implements Tool
{
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_query_vectors';
    }

    public function description(): string
    {
        return 'Search a Pinecone index for similar vectors. Provide a query vector embedding and get back the top-k most similar results. Supports metadata filtering to narrow results.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL (e.g., "idx-abc123.svc.us-east-1.pinecone.io"). Get this from the get_index tool response.'],
            'vector' => ['type' => 'array', 'required' => true, 'description' => 'The query vector embedding (array of floats). Must match the index dimension.'],
            'top_k' => ['type' => 'integer', 'description' => 'Number of top results to return (default: 10).'],
            'filter' => ['type' => 'object', 'description' => 'Metadata filter for narrowing results. Example: {"genre": {"$eq": "action"}}.'],
            'include_metadata' => ['type' => 'boolean', 'description' => 'Whether to include vector metadata in results (default: true).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }

            if (empty($args['index_host'])) {
                return ToolResult::error('Index host is required. Use the get_index tool to find the host URL for your index.');
            }

            if (empty($args['vector']) || !is_array($args['vector'])) {
                return ToolResult::error('Query vector is required and must be an array of floats.');
            }

            $topK = isset($args['top_k']) ? (int) $args['top_k'] : 10;
            $filter = $args['filter'] ?? null;
            $includeMetadata = $args['include_metadata'] ?? true;

            $result = $this->service->queryVectors(
                $args['index_host'],
                $args['vector'],
                $topK,
                $filter,
                (bool) $includeMetadata,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
