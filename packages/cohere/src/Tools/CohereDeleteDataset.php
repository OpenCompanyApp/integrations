<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete one Cohere dataset.
 *
 * Use when a dataset is no longer needed before Cohere's automatic retention expiry.
 */
class CohereDeleteDataset extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_delete_dataset';
    }

    public function description(): string
    {
        return 'Delete a Cohere dataset by ID. Cohere also automatically expires datasets after its retention period.';
    }

    public function parameters(): array
    {
        return [
            'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Dataset ID to delete.'],
        ];
    }

    /**
     * Execute the Cohere Delete Dataset API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing dataset_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->deleteDataset($this->requireString($args, 'dataset_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
