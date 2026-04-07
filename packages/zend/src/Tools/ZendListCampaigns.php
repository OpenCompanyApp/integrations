<?php

namespace OpenCompany\Integrations\Zend\Tools;

use OpenCompany\Integrations\Zend\ZendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all email marketing campaigns in the Zendesk account.
 */
class ZendListCampaigns implements Tool
{
    public function __construct(
        private ZendService $service,
    ) {}

    public function name(): string
    {
        return 'zend_list_campaigns';
    }

    public function description(): string
    {
        return 'List all email marketing campaigns in your Zendesk account. Returns campaign IDs, subjects, and status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $result = $this->service->listCampaigns();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
