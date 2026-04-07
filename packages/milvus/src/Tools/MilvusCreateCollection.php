<?php

namespace OpenCompany\Integrations\Milvus\Tools;

use OpenCompany\Integrations\Milvus\MilvusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MilvusCreateCollection implements Tool
{
    public function __construct(
        private MilvusService $service,
    ) {}

    public function name(): string
    {
        return 'milvus_create_collection';
    }

    public function description(): string
    {
        return 'Create a new vector collection in Milvus. A collection requires a name and the embedding dimension size.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to create.'],
            'dimension' => ['type' => 'integer', 'required' => true, 'description' => 'The dimension of the embedding vectors to be stored in this collection.'],
            'description' => ['type' => 'string', 'description' => 'An optional description of the collection.'],
            'params' => ['type' => 'object', 'description' => 'Optional collection parameters such as index type and metric type (JSON object).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Milvus integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $dimension = $args['dimension'] ?? 0;
            if ($dimension < 1) {
                return ToolResult::error('dimension must be a positive integer.');
            }

            $result = $this->service->createCollection(
                name: $name,
                dimension: (int) $dimension,
                description: $args['description'] ?? null,
                params: $args['params'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
