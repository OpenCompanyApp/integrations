<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deals in Zendesk Sell with pagination and optional status filter.
 *
 * Returns a paginated list of deals. Filter by status (open, won, lost,
 * abandoned) to narrow results. Use page and per_page to navigate through
 * large result sets.
 */
class ZendeskSellListDeals implements Tool
{
    public function __construct(
        private ZendeskSellService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_sell_list_deals';
    }

    public function description(): string
    {
        return 'List deals in Zendesk Sell. Optionally filter by status (open, won, lost, abandoned). Returns paginated results.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Defaults to 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of deals per page (max 100). Defaults to 25.'],
            'status' => ['type' => 'string', 'description' => 'Filter by deal status: "open", "won", "lost", or "abandoned".'],
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
            $status = $args['status'] ?? null;

            $result = $this->service->listDeals($page, $perPage, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
