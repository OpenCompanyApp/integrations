<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Pinecone vector index.
 *
 * Returns the index configuration including dimension, metric, status,
 * host URL, and deployment spec.
 */
class PineconeGetIndex implements Tool
{
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_get_index';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Pinecone vector index, including its dimension, metric, host URL, and status.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Index name is required.');
            }

            $result = $this->service->getIndex($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
