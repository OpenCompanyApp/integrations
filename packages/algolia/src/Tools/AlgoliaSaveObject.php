<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Save (create or replace) a record in an Algolia index.
 */
class AlgoliaSaveObject implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_save_object';
    }

    public function description(): string
    {
        return 'Create or replace a record in an Algolia index. The object is identified by its objectID. If a record with this objectID exists, it will be fully replaced.';
    }

    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index.'],
            'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier for the record.'],
            'body' => ['type' => 'object', 'required' => true, 'description' => 'The complete record data. Must include all attributes you want stored. The objectID will be set automatically.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            $indexName = $args['indexName'];
            $objectID = $args['objectID'];
            $body = $args['body'];

            if (!is_array($body)) {
                return ToolResult::error('The body parameter must be an object (associative array).');
            }

            $result = $this->service->saveObject($indexName, $objectID, $body);

            return ToolResult::success([
                'objectID' => $result['objectID'] ?? $objectID,
                'taskID' => $result['taskID'] ?? null,
                'updatedAt' => $result['updatedAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
