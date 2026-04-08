<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific support ticket by ID.
 */
class FreshdeskGetTicket implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_get_ticket';
    }

    public function description(): string
    {
        return 'Get full details of a specific support ticket including description, custom fields, conversation history, and associated contacts.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID.'],
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

            $result = $this->service->getTicket($ticketId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
