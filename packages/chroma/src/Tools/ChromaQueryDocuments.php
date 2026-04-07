<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\Integrations\Chroma\ChromaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChromaQueryDocuments implements Tool
{
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_query_documents';
    }

    public function description(): string
    {
        return 'Search for similar documents in a Chroma collection using query embeddings or text. Returns the most similar documents ranked by distance.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The collection name or UUID to query.'],
            'query_embeddings' => ['type' => 'array', 'description' => 'Array of query embedding vectors. Each embedding is an array of floats.'],
            'query_texts' => ['type' => 'array', 'description' => 'Array of query text strings. Chroma will generate embeddings automatically.'],
            'n_results' => ['type' => 'integer', 'description' => 'Number of results to return per query (default: 10).'],
            'where' => ['type' => 'string', 'description' => 'JSON-encoded filter expression for metadata filtering, e.g. {"category": "tech"}.'],
            'where_document' => ['type' => 'string', 'description' => 'JSON-encoded filter on document content, e.g. {"$contains": "search term"}.'],
            'include' => ['type' => 'array', 'description' => 'Fields to include in response: documents, embeddings, metadatas, distances. Default: ["documents", "metadatas", "distances"].'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            $collectionId = $args['collection_id'] ?? '';
            if (empty($collectionId)) {
                return ToolResult::error('collection_id is required.');
            }

            $body = [];

            if (isset($args['query_embeddings'])) {
                $body['query_embeddings'] = $args['query_embeddings'];
            } elseif (isset($args['query_texts'])) {
                $body['query_texts'] = $args['query_texts'];
            } else {
                return ToolResult::error('Either query_embeddings or query_texts must be provided.');
            }

            if (isset($args['n_results'])) {
                $body['n_results'] = (int) $args['n_results'];
            }

            if (isset($args['where'])) {
                $where = $args['where'];
                $body['where'] = is_string($where) ? json_decode($where, true) : $where;
            }

            if (isset($args['where_document'])) {
                $whereDoc = $args['where_document'];
                $body['where_document'] = is_string($whereDoc) ? json_decode($whereDoc, true) : $whereDoc;
            }

            if (isset($args['include'])) {
                $body['include'] = $args['include'];
            }

            $result = $this->service->queryDocuments($collectionId, $body);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $result
     */
    private function formatResponse(array $result): array
    {
        return $result;
    }
}
