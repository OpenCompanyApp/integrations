<?php

namespace OpenCompany\Integrations\GetResponse\Tools;

use OpenCompany\Integrations\GetResponse\GetResponseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetResponseListCampaigns implements Tool
{
    public function __construct(
        private GetResponseService $service,
    ) {}

    public function name(): string
    {
        return 'getresponse_list_campaigns';
    }

    public function description(): string
    {
        return 'List all campaigns in your GetResponse account. Returns campaign IDs and names that can be used when creating contacts.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GetResponse integration is not configured.');
            }

            $result = $this->service->listCampaigns();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
