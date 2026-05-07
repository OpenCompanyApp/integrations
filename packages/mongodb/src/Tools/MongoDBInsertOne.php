<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Insert one document into a MongoDB Atlas Data API collection.
 *
 * Returns the Data API insertedId response.
 */
class MongoDBInsertOne implements Tool
{
    /**
     * @param  MongoDBService  $service  MongoDB Atlas Data API client.
     */
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_insert_one';
    }

    public function description(): string
    {
        return 'Insert a single document into a MongoDB Atlas collection. Returns the inserted document ID.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'document' => ['type' => 'object', 'required' => true, 'description' => 'The document to insert (e.g., {"name": "Alice", "age": 30}). Do not include _id unless you want a custom value.'],
        ];
    }

    /**
     * Insert one document into the configured collection.
     *
     * @param  array<string, mixed>  $args  Tool arguments (database, collection, document).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MongoDB Atlas integration is not configured.');
            }

            $document = $args['document'];

            if (is_string($document)) {
                $document = json_decode($document, true) ?? [];
            }

            $result = $this->service->insertOne($args['database'], $args['collection'], $document);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
