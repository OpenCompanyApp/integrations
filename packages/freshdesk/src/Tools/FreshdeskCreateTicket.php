<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new support ticket in Freshdesk.
 */
class FreshdeskCreateTicket implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_create_ticket';
    }

    public function description(): string
    {
        return 'Create a new support ticket. Requires a subject, description, and requester email. Optionally set priority and status.';
    }

    public function parameters(): array
    {
        return [
            'subject'     => ['type' => 'string',  'required' => true, 'description' => 'Subject of the ticket.'],
            'description' => ['type' => 'string',  'required' => true, 'description' => 'HTML description of the ticket.'],
            'email'       => ['type' => 'string',  'required' => true, 'description' => 'Email address of the requester.'],
            'priority'    => ['type' => 'integer', 'description' => 'Priority: 1=Low, 2=Medium, 3=High, 4=Urgent.'],
            'status'      => ['type' => 'integer', 'description' => 'Status: 2=Open, 3=Pending, 4=Resolved, 5=Closed.'],
            'type'        => ['type' => 'string',  'description' => 'Ticket type (e.g., "Question", "Incident", "Problem").'],
            'tags'        => ['type' => 'array',   'description' => 'Array of tags to assign.'],
            'group_id'    => ['type' => 'integer', 'description' => 'ID of the group to assign the ticket to.'],
            'assignee_id' => ['type' => 'integer', 'description' => 'ID of the agent to assign the ticket to.'],
            'cc_emails'   => ['type' => 'array',   'description' => 'Array of email addresses to CC.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            if (empty($args['subject']) || empty($args['description']) || empty($args['email'])) {
                return ToolResult::error('subject, description, and email are required.');
            }

            $data = array_filter([
                'subject'      => $args['subject'],
                'description'  => $args['description'],
                'email'        => $args['email'],
                'priority'     => $args['priority'] ?? null,
                'status'       => $args['status'] ?? null,
                'type'         => $args['type'] ?? null,
                'tags'         => $args['tags'] ?? null,
                'group_id'     => $args['group_id'] ?? null,
                'responder_id' => $args['assignee_id'] ?? null,
                'cc_emails'    => $args['cc_emails'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->createTicket($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
