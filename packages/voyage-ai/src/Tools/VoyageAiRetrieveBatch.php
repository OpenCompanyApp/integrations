<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Voyage AI batch job by ID.
 */
class VoyageAiRetrieveBatch extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_retrieve_batch';
    }

    public function description(): string
    {
        return 'Retrieve a Voyage AI batch job by batch_id.';
    }

    public function parameters(): array
    {
        return [
            'batch_id' => ['type' => 'string', 'required' => true, 'description' => 'Voyage AI batch ID.'],
        ];
    }

    /**
     * Execute the retrieve batch API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments with batch_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            return ToolResult::success($this->service->retrieveBatch($this->requireString($args, 'batch_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
