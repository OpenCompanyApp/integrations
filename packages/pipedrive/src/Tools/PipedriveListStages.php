<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List stages in Pipedrive CRM, optionally filtered by pipeline.
 *
 * Returns stage names, IDs, and their associated pipeline.
 */
class PipedriveListStages implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_list_stages';
    }

    public function description(): string
    {
        return 'List stages in Pipedrive. Optionally filter by pipeline_id to get stages for a specific pipeline.';
    }

    public function parameters(): array
    {
        return [
            'pipeline_id' => ['type' => 'integer', 'description' => 'Filter stages by pipeline ID.'],
        ];
    }

    /**
     * List Pipedrive stages, optionally filtered by pipeline.
     *
     * @param  array<string, mixed>  $args  Tool arguments (pipeline_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $params = [];

            if (! empty($args['pipeline_id'])) {
                $params['pipeline_id'] = (int) $args['pipeline_id'];
            }

            $result = $this->service->listStages($params);
            $stages = $result['data'] ?? $result;

            return ToolResult::success($stages);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
