<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a record from an Algolia index by its objectID.
 */
class AlgoliaDeleteObject implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_delete_object';
    }

    public function description(): string
    {
        return 'Delete a record from an Algolia index by its objectID. This action is irreversible.';
    }

    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index.'],
            'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the record to delete.'],
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

            $result = $this->service->deleteObject($indexName, $objectID);

            return ToolResult::success([
                'objectID' => $result['objectID'] ?? $objectID,
                'taskID' => $result['taskID'] ?? null,
                'deletedAt' => $result['deletedAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
