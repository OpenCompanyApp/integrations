<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Partially update specific attributes of a record without replacing the entire object.
 */
class AlgoliaPartialUpdate implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_partial_update';
    }

    public function description(): string
    {
        return 'Update specific attributes of a record without replacing the entire object. Only the specified attributes will be changed; all other attributes remain unchanged.';
    }

    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index.'],
            'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the record to update.'],
            'attributes' => ['type' => 'object', 'required' => true, 'description' => 'Key-value pairs of attributes to update. Only the specified attributes will be changed. Use special operations like {"_operation":"Increment","value":1} for atomic updates.'],
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
            $attributes = $args['attributes'];

            if (!is_array($attributes)) {
                return ToolResult::error('The attributes parameter must be an object (associative array).');
            }

            $result = $this->service->partialUpdate($indexName, $objectID, $attributes);

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
