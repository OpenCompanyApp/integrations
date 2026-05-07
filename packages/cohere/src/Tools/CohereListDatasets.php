<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Cohere datasets.
 *
 * Supports dataset type, date, limit, and offset filters from the v1 Datasets API.
 */
class CohereListDatasets extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_list_datasets';
    }

    public function description(): string
    {
        return 'List Cohere datasets with optional datasetType, before, after, limit, and offset filters.';
    }

    public function parameters(): array
    {
        return [
            'datasetType' => ['type' => 'string', 'description' => 'Optional dataset type filter. Use Cohere casing: datasetType.'],
            'before' => ['type' => 'string', 'description' => 'Return datasets before this ISO date-time.'],
            'after' => ['type' => 'string', 'description' => 'Return datasets after this ISO date-time.'],
            'limit' => ['type' => 'number', 'description' => 'Maximum number of results.'],
            'offset' => ['type' => 'number', 'description' => 'Offset into the result set.'],
        ];
    }

    /**
     * Execute the Cohere List Datasets API call.
     *
     * @param  array<string, mixed>  $args  Query parameters for dataset listing.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->listDatasets($this->only($args, [
                'datasetType',
                'before',
                'after',
                'limit',
                'offset',
            ])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
