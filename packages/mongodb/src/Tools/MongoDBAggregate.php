<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MongoDBAggregate implements Tool
{
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_aggregate';
    }

    public function description(): string
    {
        return 'Run an aggregation pipeline on a MongoDB Atlas collection. Supports all pipeline stages ($match, $group, $sort, $project, $limit, $lookup, etc.).';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'pipeline' => ['type' => 'array', 'required' => true, 'description' => 'Array of pipeline stages (e.g., [{"$match": {"status": "active"}}, {"$group": {"_id": "$category", "count": {"$sum": 1}}}]).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MongoDB Atlas integration is not configured.');
            }

            $pipeline = $args['pipeline'];

            if (is_string($pipeline)) {
                $pipeline = json_decode($pipeline, true) ?? [];
            }

            if (empty($pipeline)) {
                return ToolResult::error('The aggregation pipeline must not be empty.');
            }

            $result = $this->service->aggregate($args['database'], $args['collection'], $pipeline);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
