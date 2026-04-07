<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\Integrations\Chroma\ChromaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChromaGetDocument implements Tool
{
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_get_document';
    }

    public function description(): string
    {
        return 'Retrieve specific documents from a Chroma collection by their IDs. Returns the full documents including text, embeddings, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The collection name or UUID.'],
            'ids' => ['type' => 'array', 'description' => 'Array of document IDs to retrieve.'],
            'where' => ['type' => 'string', 'description' => 'JSON-encoded metadata filter, e.g. {"category": "tech"}.'],
            'where_document' => ['type' => 'string', 'description' => 'JSON-encoded document content filter, e.g. {"$contains": "search term"}.'],
            'include' => ['type' => 'array', 'description' => 'Fields to include: documents, embeddings, metadatas. Default: ["documents", "metadatas"].'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of documents to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of documents to skip for pagination.'],
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

            if (isset($args['ids'])) {
                $body['ids'] = $args['ids'];
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

            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }

            if (isset($args['offset'])) {
                $body['offset'] = (int) $args['offset'];
            }

            $result = $this->service->getDocument($collectionId, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
