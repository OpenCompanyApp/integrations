<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Zendesk tickets with pagination and filtering.
 *
 * Returns a paginated list of tickets with their IDs, subjects, status, and metadata.
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
        return <<<'MD'
        List Zendesk tickets with pagination and filtering.
        Returns ticket IDs, subjects, status, priority, and created dates.
        Use per_page, page, and status for pagination and filtering.
        MD;
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of tickets per page (default 25, max 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed).'],
            'sort_by' => ['type' => 'string', 'description' => 'Field to sort by (e.g. "created_at", "updated_at", "priority").'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort order: "asc" or "desc".'],
            'status' => ['type' => 'string', 'description' => 'Filter by ticket status: "new", "open", "pending", "hold", "solved", "closed".'],
        ];
    }

    /**
     * List Zendesk tickets with optional pagination and filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (per_page, page, sort_by, sort_order, status)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $params = [];

            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (! empty($args['sort_by'])) {
                $params['sort_by'] = $args['sort_by'];
            }
            if (! empty($args['sort_order'])) {
                $params['sort_order'] = $args['sort_order'];
            }
            if (! empty($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listTickets($params);

            $tickets = array_map(function (array $ticket): array {
                return [
                    'id' => $ticket['id'] ?? '',
                    'subject' => $ticket['subject'] ?? '',
                    'status' => $ticket['status'] ?? '',
                    'priority' => $ticket['priority'] ?? '',
                    'type' => $ticket['type'] ?? '',
                    'created_at' => $ticket['created_at'] ?? '',
                    'updated_at' => $ticket['updated_at'] ?? '',
                    'requester_id' => $ticket['requester_id'] ?? '',
                    'assignee_id' => $ticket['assignee_id'] ?? '',
                ];
            }, $result['tickets'] ?? []);

            $output = ['results' => $tickets];

            if (isset($result['next_page'])) {
                $output['next_page'] = $result['next_page'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
