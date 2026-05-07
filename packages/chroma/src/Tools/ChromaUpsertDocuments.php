<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chroma\ChromaService;

/**
 * Create or update records in a Chroma collection.
 */
class ChromaUpsertDocuments implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_upsert_documents';
    }

    public function description(): string
    {
        return 'Upsert records in a Chroma collection.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection UUID or name.'],
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'Record IDs to upsert.'],
            'embeddings' => ['type' => 'array', 'required' => true, 'description' => 'Embedding vectors for each record.'],
            'documents' => ['type' => 'array', 'description' => 'Optional document strings.'],
            'metadatas' => ['type' => 'array', 'description' => 'Optional metadata objects.'],
            'uris' => ['type' => 'array', 'description' => 'Optional URI strings.'],
        ];
    }

    /**
     * Execute the record upsert request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            $collectionId = (string) ($args['collection_id'] ?? '');
            if ($collectionId === '') {
                return ToolResult::error('collection_id is required.');
            }

            if (empty($args['ids'])) {
                return ToolResult::error('ids is required.');
            }

            if (empty($args['embeddings'])) {
                return ToolResult::error('embeddings is required.');
            }

            $body = ['ids' => $args['ids'], 'embeddings' => $args['embeddings']];
            foreach (['documents', 'metadatas', 'uris'] as $key) {
                if (isset($args[$key])) {
                    $body[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->upsertDocuments($collectionId, $body));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
