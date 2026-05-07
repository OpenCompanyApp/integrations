<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chroma\ChromaService;

/**
 * Update a Chroma collection's name, metadata, or configuration.
 */
class ChromaUpdateCollection implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_update_collection';
    }

    public function description(): string
    {
        return 'Update collection name, metadata, or configuration.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection UUID or name.'],
            'new_name' => ['type' => 'string', 'description' => 'Optional new collection name.'],
            'metadata' => ['type' => 'object', 'description' => 'Optional replacement metadata.'],
            'configuration' => ['type' => 'object', 'description' => 'Optional replacement index configuration.'],
        ];
    }

    /**
     * Execute the collection update request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            $collectionId = (string) ($args['collection_id'] ?? '');
            if ($collectionId === '') {
                return ToolResult::error('collection_id is required.');
            }

            if (!isset($args['new_name']) && !isset($args['metadata']) && !isset($args['configuration'])) {
                return ToolResult::error('Provide at least one of new_name, metadata, or configuration.');
            }

            return ToolResult::success($this->service->updateCollection(
                collectionId: $collectionId,
                newName: isset($args['new_name']) ? (string) $args['new_name'] : null,
                metadata: $args['metadata'] ?? null,
                configuration: $args['configuration'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
