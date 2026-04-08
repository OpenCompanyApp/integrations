<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Zendesk tickets using query syntax.
 */
class ZendeskSearchTickets implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_search_tickets';
    }

    public function description(): string
    {
        return 'Search Zendesk tickets using query syntax. Examples: "type:ticket status:open", "status:open priority:high assignee:jane@example.com".';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query using Zendesk query syntax. Example: "type:ticket status:open".'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 25.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Search Zendesk tickets using query syntax.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, per_page, page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $query = $args['query'] ?? '';

        if (empty($query)) {
            return ToolResult::error('Search query is required.');
        }

        try {
            $params = ['query' => $query];

            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->searchTickets($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
