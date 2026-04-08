<?php

namespace OpenCompany\Integrations\Terraform\Tools;

use OpenCompany\Integrations\Terraform\TerraformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list variables for a Terraform Cloud workspace.
 *
 * Returns workspace variables including their types (Terraform or environment),
 * sensitivity flags, and values (for non-sensitive variables).
 */
class TerraformListVariables implements Tool
{
    /**
     * Create a new TerraformListVariables tool instance.
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
        return 'terraform_list_variables';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List variables for a Terraform Cloud workspace. Returns variable names, types (Terraform or environment), and sensitivity flags.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'workspaceId' => ['type' => 'string', 'description' => 'The workspace ID to list variables for (starts with "ws-").'],
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

            $workspaceId = $args['workspaceId'] ?? '';
            if (empty($workspaceId)) {
                return ToolResult::error('The "workspaceId" parameter is required.');
            }

            $result = $this->service->listVariables($workspaceId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
