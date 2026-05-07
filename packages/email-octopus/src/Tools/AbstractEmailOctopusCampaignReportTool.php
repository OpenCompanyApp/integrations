<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/**
 * Shared executor for EmailOctopus campaign report tools.
 *
 * Each subclass maps to one documented campaign report endpoint.
 */
abstract class AbstractEmailOctopusCampaignReportTool extends AbstractEmailOctopusTool
{
    protected const REPORT_TYPE = '';

    /**
     * Fetch the mapped campaign report.
     *
     * @param  array<string, mixed>  $args  Tool arguments (campaign_id, optional limit, page).
     * @return array<string, mixed>
     */
    protected function report(array $args): array
    {
        $args['report_type'] = static::REPORT_TYPE;

        return $this->service->getCampaignReport($args);
    }

    /**
     * Execute the report endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): \OpenCompany\IntegrationCore\Support\ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return \OpenCompany\IntegrationCore\Support\ToolResult::error('EmailOctopus integration is not configured.');
            }

            return \OpenCompany\IntegrationCore\Support\ToolResult::success($this->report($args));
        } catch (\Throwable $e) {
            return \OpenCompany\IntegrationCore\Support\ToolResult::error($e->getMessage());
        }
    }
}
