<?php

namespace OpenCompany\Integrations\Terraform\Tools;

use OpenCompany\Integrations\Terraform\TerraformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Terraform Cloud run.
 *
 * Returns run status, plan/apply details, and timestamps.
 */
class TerraformGetRun implements Tool
{
    /**
     * Create a new TerraformGetRun tool instance.
     *
     * @param TerraformService $service The Terraform Cloud API service.
     */
    public function __construct(
        private TerraformService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'terraform_get_run';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get details of a specific Terraform Cloud run by its ID. Returns run status, plan/apply results, and configuration version info.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'runId' => ['type' => 'string', 'description' => 'The run ID (starts with "run-").'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Terraform Cloud integration is not configured.');
            }

            $runId = $args['runId'] ?? '';
            if (empty($runId)) {
                return ToolResult::error('The "runId" parameter is required.');
            }

            $result = $this->service->getRun($runId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
