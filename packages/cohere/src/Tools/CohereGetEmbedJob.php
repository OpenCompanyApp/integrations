<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve one Cohere embed job.
 *
 * Returns status, input/output dataset IDs, model, truncation mode, and usage metadata.
 */
class CohereGetEmbedJob extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_get_embed_job';
    }

    public function description(): string
    {
        return 'Get details for a Cohere embed job, including status and output_dataset_id when complete.';
    }

    public function parameters(): array
    {
        return [
            'job_id' => ['type' => 'string', 'required' => true, 'description' => 'Embed job ID.'],
        ];
    }

    /**
     * Execute the Cohere Get Embed Job API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing job_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->getEmbedJob($this->requireString($args, 'job_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
