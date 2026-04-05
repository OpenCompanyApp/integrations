<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Zendesk tickets with pagination and sorting.
 */
class ZendeskListTickets implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_list_tickets';
    }

    public function description(): string
    {
        return 'List Zendesk tickets with optional pagination and sorting. Returns ticket IDs, subjects, statuses, and basic info.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of tickets per page (1-100). Default: 25.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for offset pagination.'],
            'sort_by' => ['type' => 'string', 'description' => 'Field to sort by (updated_at, created_at, priority, status, subject).'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort order (asc, desc). Default: desc.'],
        ];
    }

    /**
     * List Zendesk tickets with optional pagination and sorting.
     *
     * @param  array<string, mixed>  $args  Tool arguments (per_page, page, sort_by, sort_order)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        try {
            $params = [];

            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['sort_by'])) {
                $params['sort_by'] = $args['sort_by'];
            }

            if (isset($args['sort_order'])) {
                $params['sort_order'] = $args['sort_order'];
            }

            $result = $this->service->listTickets($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
