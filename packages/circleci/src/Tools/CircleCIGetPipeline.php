<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific CircleCI pipeline.
 *
 * Returns the pipeline configuration, status, trigger details,
 * and revision information for a single pipeline run.
 */
class CircleCIGetPipeline implements Tool
{
    public function __construct(
        private CircleCIService $service,
    ) {}

    public function name(): string
    {
        return 'circleci_get_pipeline';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific CircleCI pipeline, including its status, configuration, trigger source, and commit details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The pipeline ID (UUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CircleCI integration is not configured.');
            }

            $result = $this->service->getPipeline($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
