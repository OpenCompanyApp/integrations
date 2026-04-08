<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List workflows for a specific CircleCI pipeline.
 *
 * Returns all workflows that were triggered as part of a pipeline run,
 * including their status, names, and project details.
 */
class CircleCIListWorkflows implements Tool
{
    public function __construct(
        private CircleCIService $service,
    ) {}

    public function name(): string
    {
        return 'circleci_list_workflows';
    }

    public function description(): string
    {
        return 'List all workflows for a specific CircleCI pipeline. Shows workflow names, statuses (running, success, failed, etc.), and timing information.';
    }

    public function parameters(): array
    {
        return [
            'pipeline_id' => ['type' => 'string', 'required' => true, 'description' => 'The pipeline ID (UUID) to list workflows for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CircleCI integration is not configured.');
            }

            $result = $this->service->listWorkflows($args['pipeline_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
