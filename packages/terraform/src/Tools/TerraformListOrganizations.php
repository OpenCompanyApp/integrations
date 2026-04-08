<?php

namespace OpenCompany\Integrations\Terraform\Tools;

use OpenCompany\Integrations\Terraform\TerraformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Terraform Cloud organizations.
 *
 * Returns organizations the authenticated user has access to.
 */
class TerraformListOrganizations implements Tool
{
    /**
     * Create a new TerraformListOrganizations tool instance.
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
        return 'terraform_list_organizations';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List Terraform Cloud organizations the authenticated user has access to. Returns organization names and IDs.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'pageNumber' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of results per page, max 50 (default: 20).'],
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

            $pageNumber = isset($args['pageNumber']) ? (int) $args['pageNumber'] : 1;
            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 20;

            $result = $this->service->listOrganizations($pageNumber, $pageSize);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
