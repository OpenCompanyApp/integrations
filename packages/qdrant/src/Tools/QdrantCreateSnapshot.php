<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Create a snapshot for a Qdrant collection.
 */
class QdrantCreateSnapshot implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_create_snapshot';
    }

    public function description(): string
    {
        return 'Create a snapshot for a Qdrant collection.';
    }

    public function parameters(): array
    {
        return ['collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.']];
    }

    /**
     * Create a snapshot.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->createSnapshot((string) ($args['collection'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
