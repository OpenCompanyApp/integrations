<?php

namespace OpenCompany\Integrations\Braze\Tools;

use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific Braze campaign.
 *
 * Returns the full campaign configuration including targeting, messaging,
 * scheduling, and conversion tracking settings.
 *
 * @see https://www.braze.com/docs/api/endpoints/export/campaigns/get_campaign_details/
 */
class BrazeGetCampaign implements Tool
{
    public function __construct(
        private BrazeService $service,
    ) {}

    public function name(): string
    {
        return 'braze_get_campaign';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Braze campaign, including targeting rules, messaging content, schedule, and analytics.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The Braze campaign identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braze integration is not configured.');
            }

            if (empty($args['campaign_id'])) {
                return ToolResult::error('campaign_id is required.');
            }

            $result = $this->service->getCampaign($args['campaign_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
