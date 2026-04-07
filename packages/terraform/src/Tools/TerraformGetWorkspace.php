<?php

namespace OpenCompany\Integrations\Terraform\Tools;

use OpenCompany\Integrations\Terraform\TerraformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Terraform Cloud workspace.
 *
 * Returns workspace configuration including name, Terraform version,
 * working directory, VCS settings, and execution mode.
 */
class TerraformGetWorkspace implements Tool
{
    /**
     * Create a new TerraformGetWorkspace tool instance.
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
        return 'terraform_get_workspace';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get details of a specific Terraform Cloud workspace by its ID. Returns workspace configuration, status, and VCS settings.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'workspaceId' => ['type' => 'string', 'description' => 'The workspace ID (starts with "ws-").'],
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

            $result = $this->service->getWorkspace($workspaceId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
