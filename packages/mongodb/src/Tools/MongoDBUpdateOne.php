<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MongoDBUpdateOne implements Tool
{
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_update_one';
    }

    public function description(): string
    {
        return 'Update a single document in a MongoDB Atlas collection. Uses a filter to match the document and an update operations object (e.g., {"$set": {"field": "value"}}).';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'filter' => ['type' => 'object', 'required' => true, 'description' => 'MongoDB query filter to match the document (e.g., {"_id": {"$oid": "..."}}).'],
            'update' => ['type' => 'object', 'required' => true, 'description' => 'Update operations (e.g., {"$set": {"status": "active"}}). Use MongoDB update operators like $set, $inc, $push, etc.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MongoDB Atlas integration is not configured.');
            }

            $filter = $args['filter'];
            $update = $args['update'];

            if (is_string($filter)) {
                $filter = json_decode($filter, true) ?? [];
            }

            if (is_string($update)) {
                $update = json_decode($update, true) ?? [];
            }

            $result = $this->service->updateOne($args['database'], $args['collection'], $filter, $update);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
