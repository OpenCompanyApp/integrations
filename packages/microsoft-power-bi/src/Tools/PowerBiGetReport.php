<?php

namespace OpenCompany\Integrations\PowerBi\Tools;

use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Power BI report within a workspace.
 *
 * Returns a report object including id, name, webUrl, embedUrl,
 * datasetId, description, and other report metadata.
 */
class PowerBiGetReport implements Tool
{
    public function __construct(
        private PowerBiService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_get_report';
    }

    public function description(): string
    {
        return 'Get details for a specific Power BI report within a workspace, including embed URL and associated dataset.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace (group) ID (a GUID).'],
            'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report ID (a GUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $result = $this->service->getReport($args['workspace_id'], $args['report_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
