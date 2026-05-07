<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Qdrant collections.
 */
class QdrantListCollections implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(
        private QdrantService $service,
    ) {}

    public function name(): string
    {
        return 'qdrant_list_collections';
    }

    public function description(): string
    {
        return 'List all vector collections in the Qdrant cluster. Returns collection names and basic metadata.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List collections.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            $result = $this->service->listCollections();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
