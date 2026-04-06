<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upsert vectors into a Pinecone index.
 *
 * Inserts or updates vectors in the specified index. Each vector requires
 * an id, values array, and optionally a metadata object. The index host
 * URL is required and can be obtained from the get_index tool response.
 */
class PineconeUpsertVectors implements Tool
{
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_upsert_vectors';
    }

    public function description(): string
    {
        return 'Upsert (insert or update) vectors into a Pinecone index. Each vector needs an id, values array, and optional metadata. Use the index host from get_index to target the right index.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL (e.g., "idx-abc123.svc.us-east-1.pinecone.io"). Get this from the get_index tool response.'],
            'vectors' => ['type' => 'array', 'required' => true, 'description' => 'Array of vectors to upsert. Each vector is an object with "id" (string), "values" (array of floats), and optional "metadata" (object).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }

            if (empty($args['index_host'])) {
                return ToolResult::error('Index host is required. Use the get_index tool to find the host URL for your index.');
            }

            if (empty($args['vectors']) || !is_array($args['vectors'])) {
                return ToolResult::error('Vectors array is required and must contain at least one vector.');
            }

            // Validate vector structure
            foreach ($args['vectors'] as $i => $vector) {
                if (!isset($vector['id']) || !isset($vector['values'])) {
                    return ToolResult::error("Vector at index {$i} is missing required 'id' or 'values' field.");
                }
            }

            $result = $this->service->upsertVectors($args['index_host'], $args['vectors']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
