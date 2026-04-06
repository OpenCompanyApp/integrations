<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new serverless vector index in Pinecone.
 *
 * Creates a serverless index on AWS us-east-1 with the specified name,
 * dimension, and similarity metric. The index will be ready once
 * Pinecone finishes provisioning.
 */
class PineconeCreateIndex implements Tool
{
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_create_index';
    }

    public function description(): string
    {
        return 'Create a new serverless vector index in Pinecone. Specify the index name, vector dimension, and similarity metric (cosine, euclidean, or dotproduct).';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new index. Must be unique within the project.'],
            'dimension' => ['type' => 'integer', 'required' => true, 'description' => 'The dimension size of the vectors to be stored (e.g., 1536 for OpenAI text-embedding-ada-002, 3072 for text-embedding-3-large).'],
            'metric' => ['type' => 'string', 'description' => 'The similarity metric to use: "cosine" (default), "euclidean", or "dotproduct".'],
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

            if (empty($args['dimension'])) {
                return ToolResult::error('Dimension is required.');
            }

            $metric = $args['metric'] ?? 'cosine';
            $result = $this->service->createIndex(
                $args['name'],
                (int) $args['dimension'],
                $metric,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
