<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chroma\ChromaService;

/**
 * Delete records from a Chroma collection by IDs or filters.
 */
class ChromaDeleteDocuments implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_delete_documents';
    }

    public function description(): string
    {
        return 'Delete records from a collection by IDs or metadata filters.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection UUID or name.'],
            'ids' => ['type' => 'array', 'description' => 'Record IDs to delete.'],
            'where' => ['type' => 'object', 'description' => 'Metadata filter.'],
            'where_document' => ['type' => 'object', 'description' => 'Document content filter.'],
            'limit' => ['type' => 'integer', 'description' => 'Optional maximum records to delete.'],
        ];
    }

    /**
     * Execute the record delete request.
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

            $body = [];
            foreach (['ids', 'where', 'where_document', 'limit'] as $key) {
                if (isset($args[$key])) {
                    $body[$key] = $args[$key];
                }
            }

            if ($body === []) {
                return ToolResult::error('Provide at least one of ids, where, where_document, or limit.');
            }

            return ToolResult::success($this->service->deleteDocuments($collectionId, $body));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
