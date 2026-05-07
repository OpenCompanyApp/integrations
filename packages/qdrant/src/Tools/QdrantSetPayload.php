<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Set payload values on Qdrant points.
 */
class QdrantSetPayload implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_set_payload';
    }

    public function description(): string
    {
        return 'Set payload values on Qdrant points selected by IDs or filter.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Payload values to set.'],
            'points' => ['type' => 'array', 'description' => 'Point IDs to update.'],
            'filter' => ['type' => 'object', 'description' => 'Filter selector.'],
            'wait' => ['type' => 'boolean', 'description' => 'Wait for completion.'],
        ];
    }

    /**
     * Set point payload values.
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

            return ToolResult::success($this->service->setPayload($collection, $args, $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
