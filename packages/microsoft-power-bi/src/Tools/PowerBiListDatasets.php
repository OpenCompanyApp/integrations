<?php

namespace OpenCompany\Integrations\PowerBi\Tools;

use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List datasets within a Power BI workspace.
 *
 * Returns an array of dataset objects including id, name, webUrl,
 * addRowsAPIEnabled, isRefreshable, and other dataset metadata.
 */
class PowerBiListDatasets implements Tool
{
    /**
     * @param  PowerBiService  $service  The Power BI API client.
     */
    public function __construct(
        private PowerBiService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_list_datasets';
    }

    public function description(): string
    {
        return 'List datasets within a Power BI workspace. Returns dataset IDs, names, and configuration details.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace (group) ID containing the datasets (a GUID).'],
        ];
    }

    /**
     * List datasets within a Power BI workspace.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            if (empty($args['workspace_id'])) {
                return ToolResult::error('workspace_id is required.');
            }

            $result = $this->service->listDatasets($args['workspace_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
