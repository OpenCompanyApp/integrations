<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Describe Pinecone index statistics.
 *
 * Wraps the official POST /describe_index_stats data-plane operation.
 */
class PineconeDescribeIndexStats implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_describe_index_stats';
    }

    public function description(): string
    {
        return 'Describe vector count, dimensions, and namespace statistics for a Pinecone index.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL.'],
            'filter' => ['type' => 'object', 'description' => 'Optional metadata filter.'],
        ];
    }

    /**
     * Describe index statistics.
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

            return ToolResult::success($this->service->describeIndexStats(
                (string) $args['index_host'],
                is_array($args['filter'] ?? null) ? $args['filter'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
