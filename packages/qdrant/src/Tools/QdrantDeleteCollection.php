<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Delete a Qdrant collection.
 */
class QdrantDeleteCollection implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_delete_collection';
    }

    public function description(): string
    {
        return 'Delete a Qdrant collection and all of its points.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'timeout' => ['type' => 'integer', 'description' => 'Optional operation timeout in seconds.'],
        ];
    }

    /**
     * Delete a collection.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->deleteCollection((string) ($args['name'] ?? ''), array_intersect_key($args, ['timeout' => true])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
