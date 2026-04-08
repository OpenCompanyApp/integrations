<?php

namespace OpenCompany\Integrations\PowerBi\Tools;

use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List reports within a Power BI workspace.
 *
 * Returns an array of report objects including id, name, webUrl,
 * embedUrl, datasetId, and other report metadata.
 */
class PowerBiListReports implements Tool
{
    public function __construct(
        private PowerBiService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_list_reports';
    }

    public function description(): string
    {
        return 'List reports within a Power BI workspace. Returns report IDs, names, embed URLs, and associated dataset IDs.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace (group) ID containing the reports (a GUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $result = $this->service->listReports($args['workspace_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
