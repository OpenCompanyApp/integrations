<?php

namespace OpenCompany\Integrations\Actively\Tools;

use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single campaign by ID from Actively.
 *
 * Returns full campaign details including title, type, status, start/end dates,
 * and any associated metrics or metadata.
 */
class ActivelyGetCampaign implements Tool
{
    public function __construct(
        private ActivelyService $service,
    ) {}

    public function name(): string
    {
        return 'actively_get_campaign';
    }

    public function description(): string
    {
        return 'Get details of a specific campaign in Actively. Returns the campaign title, type, status, date range, and all associated metadata.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'string', 'required' => true, 'description' => 'The organization UUID.'],
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The campaign UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Actively integration is not configured.');
            }

            $result = $this->service->getCampaign($args['org_id'], $args['campaign_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
