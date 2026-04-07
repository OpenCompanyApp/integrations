<?php

namespace OpenCompany\Integrations\Milvus\Tools;

use OpenCompany\Integrations\Milvus\MilvusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MilvusInsertDocuments implements Tool
{
    public function __construct(
        private MilvusService $service,
    ) {}

    public function name(): string
    {
        return 'milvus_insert_documents';
    }

    public function description(): string
    {
        return 'Insert documents with embedding vectors into a Milvus collection. Each document requires a vector and an optional ID.';
    }

    public function parameters(): array
    {
        return [
            'collection_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to insert into.'],
            'data' => ['type' => 'array', 'required' => true, 'description' => 'Array of document objects. Each object should contain a "vector" field (array of floats) and optional "id", "color", or other scalar fields.'],
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

            $data = $args['data'] ?? [];
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $result = $this->service->insertDocuments($collectionName, ['data' => $data]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
