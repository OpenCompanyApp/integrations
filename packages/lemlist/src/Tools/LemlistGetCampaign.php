<?php

namespace OpenCompany\Integrations\Lemlist\Tools;

use OpenCompany\Integrations\Lemlist\LemlistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get details of a specific Lemlist campaign.
 *
 * Returns the full campaign object including settings, schedule, and statistics.
 */
class LemlistGetCampaign implements Tool
{
    public function __construct(
        private LemlistService $service,
    ) {}

    public function name(): string
    {
        return 'lemlist_get_campaign';
    }

    public function description(): string
    {
        return 'Get details of a specific Lemlist campaign by ID. Returns the full campaign configuration and statistics.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the campaign to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemlist integration is not configured.');
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
