<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CustomerIOListCampaigns implements Tool
{
    public function __construct(
        private CustomerIOService $service,
    ) {}

    public function name(): string
    {
        return 'customerio_list_campaigns';
    }

    public function description(): string
    {
        return 'List all campaigns in the Customer.io workspace. Campaigns are automated message sequences triggered by events or segments.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Customer.io integration is not configured.');
            }

            $result = $this->service->listCampaigns();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
