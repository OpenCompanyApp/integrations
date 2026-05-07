<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chroma\ChromaService;

/**
 * Delete a Chroma collection and all of its records.
 */
class ChromaDeleteCollection implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_delete_collection';
    }

    public function description(): string
    {
        return 'Delete a collection and all records in it.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection UUID or name.'],
        ];
    }

    /**
     * Execute the collection delete request.
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

            return ToolResult::success($this->service->deleteCollection($collectionId));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
