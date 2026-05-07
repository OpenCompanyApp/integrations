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
    /**
     * @param  PowerBiService  $service  The Power BI API client.
     */
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

    /**
     * List reports within a Power BI workspace.
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

            $result = $this->service->listReports($args['workspace_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
