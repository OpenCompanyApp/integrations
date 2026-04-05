<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List support tickets with optional filters and pagination.
 */
class FreshdeskListTickets implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_list_tickets';
    }

    public function description(): string
    {
        return 'List support tickets from Freshdesk. Supports filtering by status, priority, and pagination. Returns ticket details including subject, status, priority, requester, and assignee.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (max: 100, default: 30).'],
            'filter'   => ['type' => 'string',  'description' => 'Predefined filter: "new_and_my_open", "watching", "spam", "deleted".'],
            'company_id' => ['type' => 'integer', 'description' => 'Filter by company ID.'],
            'requester_id' => ['type' => 'integer', 'description' => 'Filter by requester ID.'],
            'email'    => ['type' => 'string',  'description' => 'Filter by requester email.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $params = array_filter([
                'page'         => $args['page'] ?? null,
                'per_page'     => $args['per_page'] ?? null,
                'filter'       => $args['filter'] ?? null,
                'company_id'   => $args['company_id'] ?? null,
                'requester_id' => $args['requester_id'] ?? null,
                'email'        => $args['email'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listTickets($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
