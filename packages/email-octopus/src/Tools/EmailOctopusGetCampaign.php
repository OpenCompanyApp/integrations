<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class EmailOctopusGetCampaign implements Tool
{
    public function __construct(
        private EmailOctopusService $service,
    ) {}

    public function name(): string
    {
        return 'emailoctopus_get_campaign';
    }

    public function description(): string
    {
        return 'Get details of a specific EmailOctopus campaign, including status, subject, content, and delivery statistics.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The campaign ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('EmailOctopus integration is not configured.');
            }

            $result = $this->service->getCampaign($args['campaign_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
