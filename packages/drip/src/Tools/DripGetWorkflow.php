<?php

namespace OpenCompany\Integrations\Drip\Tools;

use OpenCompany\Integrations\Drip\DripService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DripGetWorkflow implements Tool
{
    public function __construct(
        private DripService $service,
    ) {}

    public function name(): string
    {
        return 'drip_get_workflow';
    }

    public function description(): string
    {
        return 'Fetch a single workflow from Drip by its workflow ID. Returns full workflow details including name, status, trigger configuration, and associated actions.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The workflow ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Drip integration is not configured. Provide an API key and account ID.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Workflow ID is required.');
            }

            $result = $this->service->getWorkflow($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
