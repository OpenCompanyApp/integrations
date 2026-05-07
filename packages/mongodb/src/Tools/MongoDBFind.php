<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Query documents from a MongoDB Atlas Data API collection.
 *
 * Supports filters, projection, sort, limit, and skip.
 */
class MongoDBFind implements Tool
{
    /**
     * @param  MongoDBService  $service  MongoDB Atlas Data API client.
     */
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_find';
    }

    public function description(): string
    {
        return 'Query documents from a MongoDB Atlas collection. Supports filtering, projection, sorting, pagination (limit/skip). Returns an array of matching documents.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'filter' => ['type' => 'object', 'description' => 'MongoDB query filter (e.g., {"status": "active"}). Defaults to {} (all documents).'],
            'projection' => ['type' => 'object', 'description' => 'Fields to include/exclude (e.g., {"name": 1, "_id": 0}).'],
            'sort' => ['type' => 'object', 'description' => 'Sort specification (e.g., {"createdAt": -1}).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of documents to return.'],
            'skip' => ['type' => 'integer', 'description' => 'Number of documents to skip (for pagination).'],
        ];
    }

    /**
     * Execute a find action against the configured collection.
     *
     * @param  array<string, mixed>  $args  Tool arguments (database, collection, filter, projection, sort, limit, skip).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MongoDB Atlas integration is not configured.');
            }

            $database = $args['database'];
            $collection = $args['collection'];
            $filter = $args['filter'] ?? [];

            if (is_string($filter)) {
                $filter = json_decode($filter, true) ?? [];
            }

            $options = [];
            if (isset($args['projection'])) {
                $options['projection'] = is_string($args['projection'])
                    ? json_decode($args['projection'], true) ?? []
                    : $args['projection'];
            }
            if (isset($args['sort'])) {
                $options['sort'] = is_string($args['sort'])
                    ? json_decode($args['sort'], true) ?? []
                    : $args['sort'];
            }
            if (isset($args['limit'])) {
                $options['limit'] = (int) $args['limit'];
            }
            if (isset($args['skip'])) {
                $options['skip'] = (int) $args['skip'];
            }

            $result = $this->service->find($database, $collection, $filter, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
