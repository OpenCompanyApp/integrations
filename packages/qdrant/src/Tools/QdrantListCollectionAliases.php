<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * List aliases for a specific Qdrant collection.
 */
class QdrantListCollectionAliases implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_list_collection_aliases';
    }

    public function description(): string
    {
        return 'List aliases attached to one Qdrant collection.';
    }

    public function parameters(): array
    {
        return ['collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.']];
    }

    /**
     * List aliases for one collection.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->listCollectionAliases((string) ($args['collection'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
