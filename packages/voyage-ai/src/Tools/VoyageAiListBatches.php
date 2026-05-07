<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Voyage AI batch jobs.
 *
 * Supports the official limit and after query parameters for pagination.
 */
class VoyageAiListBatches extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_list_batches';
    }

    public function description(): string
    {
        return 'List Voyage AI batch jobs with optional pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of batches to return. Range: 1-100.'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor: batch ID after which to continue.'],
        ];
    }

    /**
     * Execute the list batches API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching list batches query params.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            return ToolResult::success($this->service->listBatches($this->only($args, ['limit', 'after'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
