<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Fetch vectors from a Pinecone index by ID.
 *
 * Wraps the official GET /vectors/fetch data-plane operation.
 */
class PineconeFetchVectors implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_fetch_vectors';
    }

    public function description(): string
    {
        return 'Fetch vectors by ID from a Pinecone index namespace.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL.'],
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'Vector IDs to fetch.', 'items' => ['type' => 'string']],
            'namespace' => ['type' => 'string', 'description' => 'Optional namespace.'],
        ];
    }

    /**
     * Fetch vectors by ID.
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
            if (empty($args['ids']) || !is_array($args['ids'])) {
                return ToolResult::error('IDs array is required.');
            }

            return ToolResult::success($this->service->fetchVectors(
                (string) $args['index_host'],
                array_values($args['ids']),
                isset($args['namespace']) ? (string) $args['namespace'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
