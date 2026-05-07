<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MongoDB\MongoDBService;

/**
 * Update multiple documents in a MongoDB Atlas Data API collection.
 *
 * Uses a filter and update operators, returning the Data API write result.
 */
class MongoDBUpdateMany implements Tool
{
    /**
     * @param  MongoDBService  $service  MongoDB Atlas Data API client.
     */
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_update_many';
    }

    public function description(): string
    {
        return 'Update multiple documents in a MongoDB Atlas collection. Uses a filter to match documents and an update operations object such as {"$set": {"status": "active"}}.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'filter' => ['type' => 'object', 'required' => true, 'description' => 'MongoDB query filter to match documents. Use a specific filter for destructive or broad updates.'],
            'update' => ['type' => 'object', 'required' => true, 'description' => 'Update operations such as {"$set": {"status": "active"}}.'],
        ];
    }

    /**
     * Update every document matching the supplied filter.
     *
     * @param  array<string, mixed>  $args  Tool arguments (database, collection, filter, update).
     */
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

            $result = $this->service->updateMany($args['database'], $args['collection'], $filter, $update);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
