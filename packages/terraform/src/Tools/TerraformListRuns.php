<?php

namespace OpenCompany\Integrations\Terraform\Tools;

use OpenCompany\Integrations\Terraform\TerraformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list runs for a Terraform Cloud workspace.
 *
 * Returns run details including status, trigger, and timestamps.
 */
class TerraformListRuns implements Tool
{
    /**
     * Create a new TerraformListRuns tool instance.
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
        return 'terraform_list_runs';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List runs for a Terraform Cloud workspace. Returns run IDs, statuses, trigger reasons, and timestamps.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'workspaceId' => ['type' => 'string', 'description' => 'The workspace ID to list runs for (starts with "ws-").'],
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

            $workspaceId = $args['workspaceId'] ?? '';
            if (empty($workspaceId)) {
                return ToolResult::error('The "workspaceId" parameter is required.');
            }

            $pageNumber = isset($args['pageNumber']) ? (int) $args['pageNumber'] : 1;
            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 20;

            $result = $this->service->listRuns($workspaceId, $pageNumber, $pageSize);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
