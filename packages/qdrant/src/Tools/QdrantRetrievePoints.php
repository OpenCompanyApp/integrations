<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Retrieve Qdrant points by id.
 */
class QdrantRetrievePoints implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_retrieve_points';
    }

    public function description(): string
    {
        return 'Retrieve Qdrant points by IDs with optional payload and vector selection.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'Point IDs to retrieve.'],
            'with_payload' => ['type' => 'boolean', 'description' => 'Include payloads.'],
            'with_vector' => ['type' => 'boolean', 'description' => 'Include vectors.'],
        ];
    }

    /**
     * Retrieve points by ids.
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
            unset($args['collection']);

            return ToolResult::success($this->service->retrievePoints($collection, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
