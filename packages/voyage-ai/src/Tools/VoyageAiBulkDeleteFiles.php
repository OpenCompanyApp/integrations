<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete multiple Voyage AI files atomically.
 *
 * Voyage treats the operation as all-or-nothing: every file ID must be valid
 * or none of the files are deleted.
 */
class VoyageAiBulkDeleteFiles extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_bulk_delete_files';
    }

    public function description(): string
    {
        return 'Delete one or more Voyage AI files in an all-or-nothing bulk delete operation.';
    }

    public function parameters(): array
    {
        return [
            'file_ids' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'File IDs to delete.'],
        ];
    }

    /**
     * Execute the bulk delete files API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments with file_ids.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            return ToolResult::success($this->service->bulkDeleteFiles($this->requireArray($args, 'file_ids')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
