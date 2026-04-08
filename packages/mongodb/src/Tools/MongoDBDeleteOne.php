<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MongoDBDeleteOne implements Tool
{
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_delete_one';
    }

    public function description(): string
    {
        return 'Delete a single document from a MongoDB Atlas collection. Uses a filter to match the document to delete.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'filter' => ['type' => 'object', 'required' => true, 'description' => 'MongoDB query filter to match the document to delete (e.g., {"_id": {"$oid": "..."}}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MongoDB Atlas integration is not configured.');
            }

            $filter = $args['filter'];

            if (is_string($filter)) {
                $filter = json_decode($filter, true) ?? [];
            }

            $result = $this->service->deleteOne($args['database'], $args['collection'], $filter);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
