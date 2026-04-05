<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing support ticket in Freshdesk.
 */
class FreshdeskUpdateTicket implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_update_ticket';
    }

    public function description(): string
    {
        return 'Update an existing support ticket. Can change subject, description, status, priority, assignee, and other fields.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id'   => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to update.'],
            'subject'     => ['type' => 'string',  'description' => 'New subject.'],
            'description' => ['type' => 'string',  'description' => 'New HTML description.'],
            'priority'    => ['type' => 'integer', 'description' => 'Priority: 1=Low, 2=Medium, 3=High, 4=Urgent.'],
            'status'      => ['type' => 'integer', 'description' => 'Status: 2=Open, 3=Pending, 4=Resolved, 5=Closed.'],
            'type'        => ['type' => 'string',  'description' => 'Ticket type.'],
            'tags'        => ['type' => 'array',   'description' => 'Replace tags (array of strings).'],
            'group_id'    => ['type' => 'integer', 'description' => 'Group ID to assign.'],
            'assignee_id' => ['type' => 'integer', 'description' => 'Agent ID to assign.'],
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

            $data = array_filter([
                'subject'      => $args['subject'] ?? null,
                'description'  => $args['description'] ?? null,
                'priority'     => $args['priority'] ?? null,
                'status'       => $args['status'] ?? null,
                'type'         => $args['type'] ?? null,
                'tags'         => $args['tags'] ?? null,
                'group_id'     => $args['group_id'] ?? null,
                'responder_id' => $args['assignee_id'] ?? null,
            ], fn ($v) => $v !== null);

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required.');
            }

            $result = $this->service->updateTicket($ticketId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
