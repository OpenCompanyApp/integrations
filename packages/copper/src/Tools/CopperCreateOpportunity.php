<?php

namespace OpenCompany\Integrations\Copper\Tools;

use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CopperCreateOpportunity implements Tool
{
    public function __construct(
        private CopperService $service,
    ) {}

    public function name(): string
    {
        return 'copper_create_opportunity';
    }

    public function description(): string
    {
        return 'Create a new opportunity (deal) in Copper CRM. Provide a name and pipeline ID. Use copper_list_pipelines first to find available pipeline IDs.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Opportunity name.'],
            'pipeline_id' => ['type' => 'integer', 'required' => true, 'description' => 'ID of the pipeline to create the opportunity in. Use copper_list_pipelines to find available IDs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Copper integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Opportunity name is required.');
            }
            if (empty($args['pipeline_id'])) {
                return ToolResult::error('Pipeline ID is required. Use copper_list_pipelines to find available pipelines.');
            }

            $data = [
                'name' => $args['name'],
                'pipeline_id' => (int) $args['pipeline_id'],
            ];

            $result = $this->service->createOpportunity($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
