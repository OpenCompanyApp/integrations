<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all workspaces in a Grist organization.
 */
class GristListWorkspaces implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_list_workspaces';
    }

    public function description(): string
    {
        return 'List all workspaces in a Grist organization.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'integer', 'required' => true, 'description' => 'Grist organization ID.'],
        ];
    }

    /**
     * List all workspaces in an organization.
     *
     * @param  array<string, mixed>  $args  Tool arguments (org_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $orgId = $args['org_id'] ?? '';

            if (empty($orgId)) {
                return ToolResult::error('org_id is required.');
            }

            $result = $this->service->listWorkspaces((int) $orgId);

            return ToolResult::success([
                'workspaces' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
