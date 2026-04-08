<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List comments on a Zendesk ticket.
 */
class ZendeskListTicketComments implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_list_ticket_comments';
    }

    public function description(): string
    {
        return 'List all comments on a Zendesk ticket. Returns comment body, author, created date, and attachments.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to list comments for.'],
        ];
    }

    /**
     * List comments on the specified Zendesk ticket.
     *
     * @param  array<string, mixed>  $args  Tool arguments (ticket_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $ticketId = $args['ticket_id'] ?? '';

        if (empty($ticketId)) {
            return ToolResult::error('Ticket ID is required.');
        }

        try {
            $result = $this->service->listTicketComments((int) $ticketId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
