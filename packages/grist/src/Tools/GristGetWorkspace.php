<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a single Grist workspace.
 */
class GristGetWorkspace implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_get_workspace';
    }

    public function description(): string
    {
        return 'Get details for a single Grist workspace, including its documents.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'integer', 'required' => true, 'description' => 'Grist workspace ID.'],
        ];
    }

    /**
     * Get a workspace by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? '';

            if (empty($workspaceId)) {
                return ToolResult::error('workspace_id is required.');
            }

            $result = $this->service->getWorkspace((int) $workspaceId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
