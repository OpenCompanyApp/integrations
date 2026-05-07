<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * List Bland AI batches.
 *
 * Retrieves v2 batches with optional take/skip pagination.
 */
class BlandAIListBatches implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_list_batches';
    }

    public function description(): string
    {
        return 'List Bland AI batches and campaigns.';
    }

    public function parameters(): array
    {
        return [
            'take' => ['type' => 'integer', 'description' => 'Number of batches to return.'],
            'skip' => ['type' => 'integer', 'description' => 'Number of batches to skip.'],
        ];
    }

    /**
     * List batches.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->listBatches(array_intersect_key($args, array_flip(['take', 'skip']))));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
