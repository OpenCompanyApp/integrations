<?php

namespace OpenCompany\Integrations\Terraform\Tools;

use OpenCompany\Integrations\Terraform\TerraformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list workspaces in a Terraform Cloud organization.
 *
 * Returns a list of workspaces with their IDs, names, and statuses.
 */
class TerraformListWorkspaces implements Tool
{
    /**
     * Create a new TerraformListWorkspaces tool instance.
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
        return 'terraform_list_workspaces';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List workspaces in a Terraform Cloud organization. Returns workspace IDs, names, Terraform versions, and locked status.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'organization' => ['type' => 'string', 'description' => 'The organization name to list workspaces for.'],
            'pageNumber' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of results per page, max 100 (default: 20).'],
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

            $organization = $args['organization'] ?? '';
            if (empty($organization)) {
                return ToolResult::error('The "organization" parameter is required.');
            }

            $pageNumber = isset($args['pageNumber']) ? (int) $args['pageNumber'] : 1;
            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 20;

            $result = $this->service->listWorkspaces($organization, $pageNumber, $pageSize);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
