<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QdrantGetCollection implements Tool
{
    public function __construct(
        private QdrantService $service,
    ) {}

    public function name(): string
    {
        return 'qdrant_get_collection';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Qdrant collection, including vector configuration, index status, and point count.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $result = $this->service->getCollection($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
