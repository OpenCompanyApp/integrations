<?php

namespace OpenCompany\Integrations\PowerBi\Tools;

use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Power BI workspaces (groups) the authenticated user has access to.
 *
 * Returns an array of workspace objects including id, name, isReadOnly,
 * isOnDedicatedCapacity, and other metadata.
 */
class PowerBiListWorkspaces implements Tool
{
    /**
     * @param  PowerBiService  $service  The Power BI API client.
     */
    public function __construct(
        private PowerBiService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_list_workspaces';
    }

    public function description(): string
    {
        return 'List Power BI workspaces (groups) the authenticated user has access to. Returns workspace IDs and names that can be used to query datasets and reports.';
    }

    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of workspaces to return (default: 100).'],
        ];
    }

    /**
     * List Power BI workspaces available to the authenticated principal.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $top = isset($args['top']) ? (int) $args['top'] : 100;
            if ($top < 1) {
                return ToolResult::error('top must be greater than 0.');
            }

            $result = $this->service->listWorkspaces($top);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
