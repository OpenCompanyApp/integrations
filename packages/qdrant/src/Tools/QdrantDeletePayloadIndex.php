<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Delete a Qdrant payload index.
 */
class QdrantDeletePayloadIndex implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_delete_payload_index';
    }

    public function description(): string
    {
        return 'Delete a payload index from a Qdrant collection field.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'field_name' => ['type' => 'string', 'required' => true, 'description' => 'Payload field name.'],
        ];
    }

    /**
     * Delete a payload index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->deletePayloadIndex((string) ($args['collection'] ?? ''), (string) ($args['field_name'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
