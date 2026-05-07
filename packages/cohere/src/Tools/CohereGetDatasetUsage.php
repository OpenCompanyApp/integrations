<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get Cohere dataset storage usage.
 *
 * Returns organization dataset storage usage in bytes.
 */
class CohereGetDatasetUsage extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_get_dataset_usage';
    }

    public function description(): string
    {
        return 'Get Cohere organization dataset storage usage in bytes.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the Cohere Get Dataset Usage API call.
     *
     * @param  array<string, mixed>  $args  Unused tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->getDatasetUsage());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
