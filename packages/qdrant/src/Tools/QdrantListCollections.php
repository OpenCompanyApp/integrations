<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QdrantListCollections implements Tool
{
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

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            $result = $this->service->listCollections();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
