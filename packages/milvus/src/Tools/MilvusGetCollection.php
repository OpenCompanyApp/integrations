<?php

namespace OpenCompany\Integrations\Milvus\Tools;

use OpenCompany\Integrations\Milvus\MilvusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MilvusGetCollection implements Tool
{
    public function __construct(
        private MilvusService $service,
    ) {}

    public function name(): string
    {
        return 'milvus_get_collection';
    }

    public function description(): string
    {
        return 'Get details of a specific Milvus collection by its name, including schema and description.';
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

            $result = $this->service->getCollection($collectionName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
