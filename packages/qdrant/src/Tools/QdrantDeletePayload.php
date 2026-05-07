<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Delete payload keys from Qdrant points.
 */
class QdrantDeletePayload implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_delete_payload';
    }

    public function description(): string
    {
        return 'Delete specific payload keys from points selected by IDs or filter.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'keys' => ['type' => 'array', 'required' => true, 'description' => 'Payload keys to delete.'],
            'points' => ['type' => 'array', 'description' => 'Point IDs to update.'],
            'filter' => ['type' => 'object', 'description' => 'Filter selector.'],
            'wait' => ['type' => 'boolean', 'description' => 'Wait for completion.'],
        ];
    }

    /**
     * Delete payload keys.
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

            return ToolResult::success($this->service->deletePayload($collection, $args, $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
