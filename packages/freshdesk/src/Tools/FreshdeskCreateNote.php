<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a private note to a support ticket.
 */
class FreshdeskCreateNote implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_create_note';
    }

    public function description(): string
    {
        return 'Add a private note to a support ticket. Notes are only visible to agents, not to the customer. Use for internal communication.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID.'],
            'body'      => ['type' => 'string', 'required' => true, 'description' => 'HTML body of the note.'],
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

            if (empty($args['body'])) {
                return ToolResult::error('body is required.');
            }

            $result = $this->service->createNote($ticketId, [
                'body' => $args['body'],
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
