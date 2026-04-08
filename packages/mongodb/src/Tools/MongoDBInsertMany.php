<?php

namespace OpenCompany\Integrations\MongoDB\Tools;

use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MongoDBInsertMany implements Tool
{
    public function __construct(
        private MongoDBService $service,
    ) {}

    public function name(): string
    {
        return 'mongodb_insert_many';
    }

    public function description(): string
    {
        return 'Insert multiple documents into a MongoDB Atlas collection in a single operation. Returns the inserted document IDs.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name.'],
            'documents' => ['type' => 'array', 'required' => true, 'description' => 'Array of documents to insert (e.g., [{"name": "Alice"}, {"name": "Bob"}]).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MongoDB Atlas integration is not configured.');
            }

            $documents = $args['documents'];

            if (is_string($documents)) {
                $documents = json_decode($documents, true) ?? [];
            }

            if (empty($documents)) {
                return ToolResult::error('The documents array must not be empty.');
            }

            $result = $this->service->insertMany($args['database'], $args['collection'], $documents);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
