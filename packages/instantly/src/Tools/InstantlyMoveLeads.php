<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Move leads between campaigns.
 */
class InstantlyMoveLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_move_leads';
    }

    public function description(): string
    {
        return 'Move leads between campaigns.';
    }

    public function parameters(): array
    {
        return [
            'lead_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated lead IDs'],
            'from_campaign_id' => ['type' => 'string', 'required' => false, 'description' => 'Source campaign ID'],
            'to_campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Destination campaign ID'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = ['lead_ids' => array_map('trim', explode(',', $args['lead_ids'])), 'to_campaign_id' => $args['to_campaign_id']]; if (isset($args['from_campaign_id'])) $body['from_campaign_id'] = $args['from_campaign_id']; $result = $this->service->moveLeads($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
