<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel an active Cohere embed job.
 *
 * Partial results are not available after cancellation according to Cohere's API.
 */
class CohereCancelEmbedJob extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_cancel_embed_job';
    }

    public function description(): string
    {
        return 'Cancel an active Cohere embed job. Cohere may bill for work already processed, and partial results are not returned.';
    }

    public function parameters(): array
    {
        return [
            'job_id' => ['type' => 'string', 'required' => true, 'description' => 'Embed job ID to cancel.'],
        ];
    }

    /**
     * Execute the Cohere Cancel Embed Job API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing job_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->cancelEmbedJob($this->requireString($args, 'job_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
