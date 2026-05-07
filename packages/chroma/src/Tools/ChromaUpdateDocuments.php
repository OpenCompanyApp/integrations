<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chroma\ChromaService;

/**
 * Update existing records in a Chroma collection.
 */
class ChromaUpdateDocuments implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_update_documents';
    }

    public function description(): string
    {
        return 'Update existing records in a Chroma collection.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection UUID or name.'],
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'Record IDs to update.'],
            'embeddings' => ['type' => 'array', 'description' => 'Updated embedding vectors.'],
            'documents' => ['type' => 'array', 'description' => 'Updated document strings.'],
            'metadatas' => ['type' => 'array', 'description' => 'Updated metadata objects.'],
            'uris' => ['type' => 'array', 'description' => 'Updated URI strings.'],
        ];
    }

    /**
     * Execute the record update request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            return ToolResult::success($this->service->updateDocuments(
                (string) ($args['collection_id'] ?? ''),
                $this->recordPayload($args),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build and validate a column-oriented record payload.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function recordPayload(array $args): array
    {
        if (($args['collection_id'] ?? '') === '') {
            throw new \InvalidArgumentException('collection_id is required.');
        }

        if (empty($args['ids'])) {
            throw new \InvalidArgumentException('ids is required.');
        }

        $body = ['ids' => $args['ids']];
        foreach (['embeddings', 'documents', 'metadatas', 'uris'] as $key) {
            if (isset($args[$key])) {
                $body[$key] = $args[$key];
            }
        }

        return $body;
    }
}
