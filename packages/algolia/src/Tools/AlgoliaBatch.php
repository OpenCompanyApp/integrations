<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Perform multiple write operations on an index in a single batch request.
 */
class AlgoliaBatch implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_batch';
    }

    public function description(): string
    {
        return 'Perform multiple write operations (addObject, updateObject, partialUpdateObject, deleteObject) in a single batch request for better performance.';
    }

    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index.'],
            'requests' => ['type' => 'array', 'required' => true, 'description' => 'Array of batch operations. Each request must have "action" (addObject, updateObject, partialUpdateObject, deleteObject) and "body" (the record data). For update/delete, body must include "objectID".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            $indexName = $args['indexName'];
            $requests = $args['requests'];

            if (!is_array($requests) || empty($requests)) {
                return ToolResult::error('The requests parameter must be a non-empty array of batch operations.');
            }

            $result = $this->service->batch($indexName, $requests);

            $objectIDs = $result['objectIDs'] ?? [];
            $taskID = $result['taskID'] ?? null;

            return ToolResult::success([
                'indexName' => $indexName,
                'objectIDs' => $objectIDs,
                'taskID' => $taskID,
                'operationCount' => count($requests),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
