<?php

namespace OpenCompany\Integrations\Terraform\Tools;

use OpenCompany\Integrations\Terraform\TerraformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated Terraform Cloud user.
 *
 * Used primarily to verify authentication and retrieve user details.
 * Returns the user's username, email, and account settings.
 */
class TerraformGetCurrentUser implements Tool
{
    /**
     * Create a new TerraformGetCurrentUser tool instance.
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
        return 'terraform_get_current_user';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get the currently authenticated Terraform Cloud user. Useful for verifying authentication and retrieving user details.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [];
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

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
