<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Delete vectors from a Pinecone index.
 *
 * Supports deletion by IDs, metadata filter, or all records in a namespace.
 */
class PineconeDeleteVectors implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_delete_vectors';
    }

    public function description(): string
    {
        return 'Delete vectors from a Pinecone namespace by IDs, metadata filter, or delete_all flag.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL.'],
            'ids' => ['type' => 'array', 'description' => 'Vector IDs to delete.', 'items' => ['type' => 'string']],
            'filter' => ['type' => 'object', 'description' => 'Metadata filter selecting vectors to delete.'],
            'delete_all' => ['type' => 'boolean', 'description' => 'Set true to delete all vectors in the namespace.'],
            'namespace' => ['type' => 'string', 'description' => 'Optional namespace.'],
        ];
    }

    /**
     * Delete vectors matching the request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }
            if (empty($args['index_host'])) {
                return ToolResult::error('Index host is required.');
            }

            $payload = [];
            if (!empty($args['ids']) && is_array($args['ids'])) {
                $payload['ids'] = array_values($args['ids']);
            }
            if (!empty($args['filter']) && is_array($args['filter'])) {
                $payload['filter'] = $args['filter'];
            }
            if (!empty($args['delete_all'])) {
                $payload['deleteAll'] = true;
            }
            if (isset($args['namespace'])) {
                $payload['namespace'] = (string) $args['namespace'];
            }

            if (!isset($payload['ids']) && !isset($payload['filter']) && !isset($payload['deleteAll'])) {
                return ToolResult::error('Provide ids, filter, or delete_all.');
            }

            return ToolResult::success($this->service->deleteVectors((string) $args['index_host'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
