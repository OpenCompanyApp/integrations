<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chroma\ChromaService;

/**
 * Count records in a Chroma collection.
 */
class ChromaCountDocuments implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_count_documents';
    }

    public function description(): string
    {
        return 'Count records in a Chroma collection.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection UUID or name.'],
        ];
    }

    /**
     * Execute the record count request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection_id).
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

            return ToolResult::success($this->service->countDocuments($collectionId));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
