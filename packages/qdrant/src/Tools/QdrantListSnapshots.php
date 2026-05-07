<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * List snapshots for a Qdrant collection.
 */
class QdrantListSnapshots implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_list_snapshots';
    }

    public function description(): string
    {
        return 'List collection snapshots available in Qdrant.';
    }

    public function parameters(): array
    {
        return ['collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.']];
    }

    /**
     * List snapshots.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->listSnapshots((string) ($args['collection'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
