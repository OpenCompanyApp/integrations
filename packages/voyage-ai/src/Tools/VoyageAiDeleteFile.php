<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a single Voyage AI file.
 */
class VoyageAiDeleteFile extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_delete_file';
    }

    public function description(): string
    {
        return 'Delete one Voyage AI file by file_id.';
    }

    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'Voyage AI file ID to delete.'],
        ];
    }

    /**
     * Execute the delete file API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments with file_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            return ToolResult::success($this->service->deleteFile($this->requireString($args, 'file_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
