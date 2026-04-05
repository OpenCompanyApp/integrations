<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MongoDBListCollections implements Tool
{
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_list_collections';
    }

    public function description(): string
    {
        return 'List all collections in a MongoDB Atlas database. Useful for discovering what data is available before running queries.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name to list collections from.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MongoDB Atlas integration is not configured.');
            }

            $result = $this->service->listCollections($args['database']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
