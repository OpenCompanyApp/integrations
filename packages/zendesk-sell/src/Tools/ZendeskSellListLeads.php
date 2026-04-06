<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List leads in Zendesk Sell with pagination.
 *
 * Returns a paginated list of leads. Use page and per_page to navigate
 * through large result sets.
 */
class ZendeskSellListLeads implements Tool
{
    public function __construct(
        private ZendeskSellService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_sell_list_leads';
    }

    public function description(): string
    {
        return 'List leads in Zendesk Sell. Returns paginated results with lead details including contact info, status, and source.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Defaults to 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of leads per page (max 100). Defaults to 25.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk Sell integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->listLeads($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
