<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve one Cohere dataset.
 *
 * Returns validation status, schema details, preserved fields, parts, and metrics.
 */
class CohereGetDataset extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_get_dataset';
    }

    public function description(): string
    {
        return 'Get a Cohere dataset by ID, including validation status, schema, dataset parts, and metrics.';
    }

    public function parameters(): array
    {
        return [
            'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Dataset ID.'],
        ];
    }

    /**
     * Execute the Cohere Get Dataset API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing dataset_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->getDataset($this->requireString($args, 'dataset_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
