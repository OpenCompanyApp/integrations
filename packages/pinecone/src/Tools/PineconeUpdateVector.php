<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Update vector values or metadata in a Pinecone index.
 *
 * Supports the official POST /vectors/update data-plane operation.
 */
class PineconeUpdateVector implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_update_vector';
    }

    public function description(): string
    {
        return 'Update vector values, sparse values, metadata, or filtered metadata in a Pinecone namespace.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL.'],
            'id' => ['type' => 'string', 'description' => 'Vector ID for single-record updates.'],
            'values' => ['type' => 'array', 'description' => 'Replacement vector values.', 'items' => ['type' => 'number']],
            'sparse_values' => ['type' => 'object', 'description' => 'Sparse vector values.'],
            'set_metadata' => ['type' => 'object', 'description' => 'Metadata fields to set.'],
            'filter' => ['type' => 'object', 'description' => 'Metadata filter for bulk metadata updates.'],
            'namespace' => ['type' => 'string', 'description' => 'Optional namespace.'],
            'dry_run' => ['type' => 'boolean', 'description' => 'Return matched count without updating when using a filter.'],
        ];
    }

    /**
     * Update vectors or metadata.
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
            foreach ([
                'id' => 'id',
                'values' => 'values',
                'sparse_values' => 'sparseValues',
                'set_metadata' => 'setMetadata',
                'filter' => 'filter',
                'namespace' => 'namespace',
                'dry_run' => 'dryRun',
            ] as $input => $output) {
                if (array_key_exists($input, $args)) {
                    $payload[$output] = $args[$input];
                }
            }

            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateVector((string) $args['index_host'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
