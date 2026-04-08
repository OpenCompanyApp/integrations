<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MongoDBFindOne implements Tool
{
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_find_one';
    }

    public function description(): string
    {
        return 'Find a single document in a MongoDB Atlas collection. Returns the first matching document or null if no match is found.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'filter' => ['type' => 'object', 'description' => 'MongoDB query filter (e.g., {"_id": {"$oid": "..."}}). Defaults to {} (first document).'],
            'projection' => ['type' => 'object', 'description' => 'Fields to include/exclude (e.g., {"name": 1, "_id": 0}).'],
        ];
    }

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

            $result = $this->service->findOne($database, $collection, $filter, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
