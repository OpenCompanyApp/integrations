<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Delete a Pinecone index.
 *
 * Wraps the official DELETE /indexes/{index_name} control-plane operation.
 */
class PineconeDeleteIndex implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_delete_index';
    }

    public function description(): string
    {
        return 'Delete a Pinecone index by name. Deletion protection must be disabled on the index first.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The index name to delete.'],
        ];
    }

    /**
     * Delete the requested index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }
            if (empty($args['name'])) {
                return ToolResult::error('Index name is required.');
            }

            return ToolResult::success($this->service->deleteIndex((string) $args['name']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
