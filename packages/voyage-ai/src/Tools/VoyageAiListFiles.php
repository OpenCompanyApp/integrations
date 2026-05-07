<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files stored by Voyage AI.
 *
 * Supports the official purpose, limit, order, and after query parameters.
 */
class VoyageAiListFiles extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_list_files';
    }

    public function description(): string
    {
        return 'List Voyage AI files, optionally filtered by purpose and paginated by cursor.';
    }

    public function parameters(): array
    {
        return [
            'purpose' => ['type' => 'string', 'description' => 'Only return files with this purpose.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of files to return. Range: 1-10000.'],
            'order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order by created_at.'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor: file ID after which to continue.'],
        ];
    }

    /**
     * Execute the list files API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching list files query params.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            $this->assertEnum('order', $args['order'] ?? null, ['asc', 'desc']);

            return ToolResult::success($this->service->listFiles($this->only($args, ['purpose', 'limit', 'order', 'after'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
