<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Configure an existing Pinecone index.
 *
 * Supports the official PATCH /indexes/{index_name} control-plane operation.
 */
class PineconeConfigureIndex implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_configure_index';
    }

    public function description(): string
    {
        return 'Configure an existing Pinecone index, such as deletion protection, tags, or supported scaling settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'],
            'config' => ['type' => 'object', 'required' => true, 'description' => 'PATCH body for the index configuration.'],
        ];
    }

    /**
     * Configure the requested index.
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
            if (empty($args['config']) || !is_array($args['config'])) {
                return ToolResult::error('Config object is required.');
            }

            return ToolResult::success($this->service->configureIndex((string) $args['name'], $args['config']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
