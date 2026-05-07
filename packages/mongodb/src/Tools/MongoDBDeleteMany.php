<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MongoDB\MongoDBService;

/**
 * Delete multiple documents from a MongoDB Atlas Data API collection.
 *
 * Wraps the official deleteMany action and returns the deleted count.
 */
class MongoDBDeleteMany implements Tool
{
    /**
     * @param  MongoDBService  $service  MongoDB Atlas Data API client.
     */
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_delete_many';
    }

    public function description(): string
    {
        return 'Delete multiple documents from a MongoDB Atlas collection. Use a precise filter; an empty filter can delete every document in the collection.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'filter' => ['type' => 'object', 'required' => true, 'description' => 'MongoDB query filter to match documents to delete.'],
        ];
    }

    /**
     * Delete every document matching the supplied filter.
     *
     * @param  array<string, mixed>  $args  Tool arguments (database, collection, filter).
     */
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

            $result = $this->service->deleteMany($args['database'], $args['collection'], $filter);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
