<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all pipelines in Pipedrive CRM.
 *
 * Returns all available pipelines with their names and IDs.
 */
class PipedriveListPipelines implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_list_pipelines';
    }

    public function description(): string
    {
        return 'List all pipelines in Pipedrive. Returns pipeline names, IDs, and their stages.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Pipedrive pipelines.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $result = $this->service->listPipelines();
            $pipelines = $result['data'] ?? $result;

            return ToolResult::success($pipelines);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
