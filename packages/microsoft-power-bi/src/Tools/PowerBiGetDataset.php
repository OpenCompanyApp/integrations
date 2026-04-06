<?php

namespace OpenCompany\Integrations\PowerBi\Tools;

use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Power BI dataset within a workspace.
 *
 * Returns a dataset object including id, name, webUrl, tables,
 * addRowsAPIEnabled, isRefreshable, defaultRetentionPolicy, and other metadata.
 */
class PowerBiGetDataset implements Tool
{
    public function __construct(
        private PowerBiService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_get_dataset';
    }

    public function description(): string
    {
        return 'Get details for a specific Power BI dataset within a workspace, including schema and refresh configuration.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace (group) ID (a GUID).'],
            'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'The dataset ID (a GUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $result = $this->service->getDataset($args['workspace_id'], $args['dataset_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
