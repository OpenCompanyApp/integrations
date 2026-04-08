<?php

namespace OpenCompany\Integrations\Freshmarketer\Tools;

use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FreshmarketerCreateCampaign — create a new marketing campaign.
 *
 * Calls POST /api/v1/campaigns with name, channel_list, and optional schedule.
 */
class FreshmarketerCreateCampaign implements Tool
{
    public function __construct(
        private FreshmarketerService $service,
    ) {}

    public function name(): string
    {
        return 'freshmarketer_create_campaign';
    }

    public function description(): string
    {
        return 'Create a new marketing campaign in Freshmarketer. Specify the campaign name, channels (e.g., "email"), and an optional schedule.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the campaign.'],
            'channel_list' => ['type' => 'array', 'description' => 'List of channels for the campaign (e.g., ["email"]).'],
            'schedule' => ['type' => 'object', 'description' => 'Schedule configuration for the campaign (e.g., {"type": "immediate"} or {"type": "scheduled", "scheduled_at": "2025-06-01T09:00:00Z"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshmarketer integration is not configured.');
            }

            if (!isset($args['name'])) {
                return ToolResult::error('Campaign name is required.');
            }

            $channelList = $args['channel_list'] ?? [];
            $schedule = $args['schedule'] ?? null;

            $result = $this->service->createCampaign($args['name'], $channelList, $schedule);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
