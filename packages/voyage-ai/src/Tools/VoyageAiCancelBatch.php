<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a validating or in-progress Voyage AI batch job.
 */
class VoyageAiCancelBatch extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_cancel_batch';
    }

    public function description(): string
    {
        return 'Cancel a Voyage AI batch job that is currently validating or in_progress.';
    }

    public function parameters(): array
    {
        return [
            'batch_id' => ['type' => 'string', 'required' => true, 'description' => 'Voyage AI batch ID to cancel.'],
        ];
    }

    /**
     * Execute the cancel batch API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments with batch_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            return ToolResult::success($this->service->cancelBatch($this->requireString($args, 'batch_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
