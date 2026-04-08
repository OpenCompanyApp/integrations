<?php

namespace OpenCompany\Integrations\Patreon\Tools;

use OpenCompany\Integrations\Patreon\PatreonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PatreonGetCampaign implements Tool
{
    public function __construct(
        private PatreonService $service,
    ) {}

    public function name(): string
    {
        return 'patreon_get_campaign';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Patreon campaign by its ID. Returns full campaign data including description, patron count, and creation date.';
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
                return ToolResult::error('Patreon integration is not configured.');
            }

            if (empty($args['campaign_id'])) {
                return ToolResult::error('campaign_id is required.');
            }

            $result = $this->service->getCampaign($args['campaign_id']);

            $campaign = $result['data'] ?? $result;

            return ToolResult::success($campaign);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
