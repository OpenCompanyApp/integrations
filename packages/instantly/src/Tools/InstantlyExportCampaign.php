<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Export a campaign to Instantly's JSON campaign format.
 */
class InstantlyExportCampaign implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_export_campaign';
    }

    public function description(): string
    {
        return 'Export a campaign to JSON format.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID'],
        ];
    }

    /**
     * Export a campaign.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            return ToolResult::success($this->service->exportCampaign($args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
