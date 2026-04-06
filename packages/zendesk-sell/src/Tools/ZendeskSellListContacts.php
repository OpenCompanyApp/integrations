<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts in Zendesk Sell with pagination and sorting.
 *
 * Returns a paginated list of contacts. Supports sorting by fields such as
 * created_at, updated_at, or last_name. Use page and per_page to navigate
 * through large result sets.
 */
class ZendeskSellListContacts implements Tool
{
    public function __construct(
        private ZendeskSellService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_sell_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in Zendesk Sell. Returns paginated results sorted by the specified field. Use this to browse, search, or export contacts from the CRM.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Defaults to 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of contacts per page (max 100). Defaults to 25.'],
            'sort_by' => ['type' => 'string', 'description' => 'Field to sort by (e.g. "created_at", "updated_at", "last_name"). Defaults to the API default.'],
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
            $sortBy = $args['sort_by'] ?? null;

            $result = $this->service->listContacts($page, $perPage, $sortBy);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
