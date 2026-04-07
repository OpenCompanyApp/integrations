<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\Integrations\Chroma\ChromaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChromaAddDocuments implements Tool
{
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_add_documents';
    }

    public function description(): string
    {
        return 'Add documents with embeddings to a Chroma collection. Each document requires an ID and either embeddings or text content.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The collection name or UUID to add documents to.'],
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'Array of unique document IDs (strings).'],
            'embeddings' => ['type' => 'array', 'description' => 'Array of embedding vectors. Each embedding is an array of floats. Required if no documents text provided.'],
            'documents' => ['type' => 'array', 'description' => 'Array of text documents. Chroma will generate embeddings if no embeddings are provided.'],
            'metadatas' => ['type' => 'array', 'description' => 'Array of metadata objects (one per document) with string values.'],
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

            $ids = $args['ids'] ?? [];
            if (empty($ids)) {
                return ToolResult::error('ids is required.');
            }

            $body = ['ids' => $ids];

            if (isset($args['embeddings'])) {
                $body['embeddings'] = $args['embeddings'];
            }

            if (isset($args['documents'])) {
                $body['documents'] = $args['documents'];
            }

            if (isset($args['metadatas'])) {
                $body['metadatas'] = $args['metadatas'];
            }

            if (!isset($body['embeddings']) && !isset($body['documents'])) {
                return ToolResult::error('Either embeddings or documents must be provided.');
            }

            $result = $this->service->addDocuments($collectionId, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
