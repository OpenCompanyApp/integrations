<?php

namespace OpenCompany\Integrations\Milvus\Tools;

use OpenCompany\Integrations\Milvus\MilvusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MilvusGetCollectionStats implements Tool
{
    public function __construct(
        private MilvusService $service,
    ) {}

    public function name(): string
    {
        return 'milvus_get_collection_stats';
    }

    public function description(): string
    {
        return 'Get statistics for a Milvus collection, including row count and index information.';
    }

    public function parameters(): array
    {
        return [
            'collection_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Milvus integration is not configured.');
            }

            $collectionName = $args['collection_name'] ?? '';
            if (empty($collectionName)) {
                return ToolResult::error('collection_name is required.');
            }

            $result = $this->service->getCollectionStats($collectionName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
