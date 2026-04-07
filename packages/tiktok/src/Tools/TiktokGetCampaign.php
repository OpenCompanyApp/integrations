<?php

namespace OpenCompany\Integrations\TikTok\Tools;

use OpenCompany\Integrations\TikTok\TiktokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TiktokGetCampaign implements Tool
{
    public function __construct(
        private TiktokService $service,
    ) {}

    public function name(): string
    {
        return 'tiktok_get_campaign';
    }

    public function description(): string
    {
        return 'Get details for a specific TikTok advertising campaign, including budget, schedule, and performance.';
    }

    public function parameters(): array
    {
        return [
            'advertiser_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The TikTok advertiser ID.',
            ],
            'campaign_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The TikTok campaign ID.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TikTok integration is not configured.');
            }

            if (empty($args['advertiser_id'])) {
                return ToolResult::error('advertiser_id is required.');
            }

            if (empty($args['campaign_id'])) {
                return ToolResult::error('campaign_id is required.');
            }

            $result = $this->service->getCampaign($args['advertiser_id'], $args['campaign_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
