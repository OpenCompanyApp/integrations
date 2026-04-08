<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all subscriber lists in the Campaign Monitor account.
 */
class CampaignMonitorListLists implements Tool
{
    public function __construct(
        private CampaignMonitorService $service,
    ) {}

    public function name(): string
    {
        return 'campaignmonitor_list_lists';
    }

    public function description(): string
    {
        return 'List all subscriber lists in your Campaign Monitor account. Returns list IDs and names.';
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

            $result = $this->service->listLists();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
