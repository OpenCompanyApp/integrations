<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a support ticket permanently from Freshdesk.
 */
class FreshdeskDeleteTicket implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_delete_ticket';
    }

    public function description(): string
    {
        return 'Permanently delete a support ticket. This action cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $ticketId = (int) ($args['ticket_id'] ?? 0);
            if ($ticketId <= 0) {
                return ToolResult::error('ticket_id is required and must be a positive integer.');
            }

            $this->service->deleteTicket($ticketId);

            return ToolResult::success("Ticket {$ticketId} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
