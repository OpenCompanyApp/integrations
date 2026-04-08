<?php

namespace OpenCompany\Integrations\Milvus\Tools;

use OpenCompany\Integrations\Milvus\MilvusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MilvusListCollections implements Tool
{
    public function __construct(
        private MilvusService $service,
    ) {}

    public function name(): string
    {
        return 'milvus_list_collections';
    }

    public function description(): string
    {
        return 'List all vector collections in Milvus. Returns collection names and details that can be used for further operations.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of collections to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of collections to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Milvus integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $result = $this->service->listCollections($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
