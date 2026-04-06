<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all email campaigns sent from the Campaign Monitor account.
 */
class CampaignMonitorListCampaigns implements Tool
{
    public function __construct(
        private CampaignMonitorService $service,
    ) {}

    public function name(): string
    {
        return 'campaignmonitor_list_campaigns';
    }

    public function description(): string
    {
        return 'List all email campaigns in your Campaign Monitor account. Returns campaign IDs, subjects, and status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Campaign Monitor integration is not configured.');
            }

            $result = $this->service->listCampaigns();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
