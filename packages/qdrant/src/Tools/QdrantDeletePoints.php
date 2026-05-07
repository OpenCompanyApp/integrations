<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Delete Qdrant points by ids or filter.
 */
class QdrantDeletePoints implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_delete_points';
    }

    public function description(): string
    {
        return 'Delete Qdrant points by point IDs or filter selector.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'points' => ['type' => 'array', 'description' => 'Point IDs to delete.'],
            'filter' => ['type' => 'object', 'description' => 'Filter selector for points to delete.'],
            'wait' => ['type' => 'boolean', 'description' => 'Wait for completion.'],
            'ordering' => ['type' => 'string', 'description' => 'Write ordering guarantee.'],
        ];
    }

    /**
     * Delete points.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            $collection = (string) ($args['collection'] ?? '');
            $params = array_intersect_key($args, ['wait' => true, 'ordering' => true]);
            foreach (['collection', 'wait', 'ordering'] as $key) {
                unset($args[$key]);
            }

            return ToolResult::success($this->service->deletePoints($collection, $args, $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
