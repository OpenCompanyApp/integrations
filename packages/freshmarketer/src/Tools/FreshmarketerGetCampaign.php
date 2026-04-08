<?php

namespace OpenCompany\Integrations\Freshmarketer\Tools;

use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FreshmarketerGetCampaign — retrieve details for a single campaign.
 *
 * Calls POST /api/v1/campaigns/{id} to fetch full campaign details.
 */
class FreshmarketerGetCampaign implements Tool
{
    public function __construct(
        private FreshmarketerService $service,
    ) {}

    public function name(): string
    {
        return 'freshmarketer_get_campaign';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific marketing campaign by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The campaign ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshmarketer integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Campaign ID is required.');
            }

            $result = $this->service->getCampaign($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
