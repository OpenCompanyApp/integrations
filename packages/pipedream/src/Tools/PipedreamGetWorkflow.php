<?php

namespace OpenCompany\Integrations\Pipedream\Tools;

use OpenCompany\Integrations\Pipedream\PipedreamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PipedreamGetWorkflow implements Tool
{
    public function __construct(
        private PipedreamService $service,
    ) {}

    public function name(): string
    {
        return 'pipedream_get_workflow';
    }

    public function description(): string
    {
        return 'Get details of a specific Pipedream workflow by ID, including its configuration, steps, and current status.';
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
                return ToolResult::error('Pipedream integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Workflow ID is required.');
            }

            $result = $this->service->getWorkflow($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
