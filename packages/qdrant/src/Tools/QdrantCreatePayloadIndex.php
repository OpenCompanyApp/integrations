<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Create a Qdrant payload index for faster filtering.
 */
class QdrantCreatePayloadIndex implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_create_payload_index';
    }

    public function description(): string
    {
        return 'Create a payload index for a collection field to speed up filtering.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'field_name' => ['type' => 'string', 'required' => true, 'description' => 'Payload field name.'],
            'field_schema' => ['type' => 'object', 'required' => true, 'description' => 'Qdrant field schema, e.g. keyword, integer, float, geo, bool, datetime, uuid, or text.'],
        ];
    }

    /**
     * Create a payload index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->createPayloadIndex((string) ($args['collection'] ?? ''), [
                'field_name' => $args['field_name'] ?? '',
                'field_schema' => $args['field_schema'] ?? null,
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
