<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Cohere embed jobs.
 *
 * Returns the authenticated user's embed job history.
 */
class CohereListEmbedJobs extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_list_embed_jobs';
    }

    public function description(): string
    {
        return 'List Cohere embed jobs for the authenticated user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the Cohere List Embed Jobs API call.
     *
     * @param  array<string, mixed>  $args  Unused tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->listEmbedJobs());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
