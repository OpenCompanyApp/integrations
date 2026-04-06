<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific CircleCI workflow.
 *
 * Returns the workflow status, name, project slug, pipeline ID,
 * creation and stop times, and duration.
 */
class CircleCIGetWorkflow implements Tool
{
    public function __construct(
        private CircleCIService $service,
    ) {}

    public function name(): string
    {
        return 'circleci_get_workflow';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific CircleCI workflow, including its status, timing, duration, and associated project.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The workflow ID (UUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CircleCI integration is not configured.');
            }

            $result = $this->service->getWorkflow($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
