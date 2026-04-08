<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific subscriber list.
 */
class CampaignMonitorGetList implements Tool
{
    public function __construct(
        private CampaignMonitorService $service,
    ) {}

    public function name(): string
    {
        return 'campaignmonitor_get_list';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific subscriber list, including subscriber counts and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber list ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Campaign Monitor integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('list_id is required.');
            }

            $result = $this->service->getList($args['list_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
