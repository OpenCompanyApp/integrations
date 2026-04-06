<?php

namespace OpenCompany\Integrations\Pipedream\Tools;

use OpenCompany\Integrations\Pipedream\PipedreamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PipedreamListTriggers implements Tool
{
    public function __construct(
        private PipedreamService $service,
    ) {}

    public function name(): string
    {
        return 'pipedream_list_triggers';
    }

    public function description(): string
    {
        return 'List event triggers for a specific Pipedream workflow. Triggers define the events that cause a workflow to run.';
    }

    public function parameters(): array
    {
        return [
            'workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'The workflow ID to list triggers for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pipedream integration is not configured.');
            }

            if (empty($args['workflow_id'])) {
                return ToolResult::error('Workflow ID is required.');
            }

            $result = $this->service->listTriggers($args['workflow_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
