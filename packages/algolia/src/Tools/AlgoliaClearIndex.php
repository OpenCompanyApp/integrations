<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Clear all records from an Algolia index.
 */
class AlgoliaClearIndex implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_clear_index';
    }

    public function description(): string
    {
        return 'Remove all records from an Algolia index. The index itself is preserved with its settings. This action is irreversible.';
    }

    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index to clear.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            $result = $this->service->clearIndex($args['indexName']);

            return ToolResult::success([
                'indexName' => $args['indexName'],
                'taskID' => $result['taskID'] ?? null,
                'updatedAt' => $result['updatedAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
