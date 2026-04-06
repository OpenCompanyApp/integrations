<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List active subscribers on a Campaign Monitor subscriber list.
 */
class CampaignMonitorListSubscribers implements Tool
{
    public function __construct(
        private CampaignMonitorService $service,
    ) {}

    public function name(): string
    {
        return 'campaignmonitor_list_subscribers';
    }

    public function description(): string
    {
        return 'List active subscribers on a Campaign Monitor list. Returns email addresses, names, and subscription dates.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber list ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of subscribers per page (default: 100, max: 1000).'],
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

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 100;

            $result = $this->service->listSubscribers($args['list_id'], $page, $pageSize);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
