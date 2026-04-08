<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new ticket in Zendesk.
 *
 * Creates a ticket with subject, description, and optional priority/type/status fields.
 */
class ZendeskCreateTicket implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_create_ticket';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new ticket in Zendesk.
        Requires a subject and description. Optionally set priority, type, status, and assignee.
        Returns the created ticket with its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Subject of the ticket.'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'Initial description/body of the ticket.'],
            'priority' => ['type' => 'string', 'description' => 'Ticket priority: "urgent", "high", "normal", "low".'],
            'type' => ['type' => 'string', 'description' => 'Ticket type: "problem", "incident", "question", "task".'],
            'status' => ['type' => 'string', 'description' => 'Initial status: "new", "open", "pending", "hold" (default: "new").'],
            'assignee_id' => ['type' => 'string', 'description' => 'ID of the agent to assign the ticket to.'],
            'tags' => ['type' => 'array', 'description' => 'Array of tags to apply to the ticket.'],
        ];
    }

    /**
     * Create a new Zendesk ticket.
     *
     * @param  array<string, mixed>  $args  Tool arguments (subject, description, priority, type, status, assignee_id, tags)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $subject = $args['subject'] ?? '';
            if (empty($subject)) {
                return ToolResult::error('subject is required.');
            }

            $description = $args['description'] ?? '';
            if (empty($description)) {
                return ToolResult::error('description is required.');
            }

            $ticket = [
                'subject' => $subject,
                'description' => $description,
            ];

            if (! empty($args['priority'])) {
                $ticket['priority'] = $args['priority'];
            }
            if (! empty($args['type'])) {
                $ticket['type'] = $args['type'];
            }
            if (! empty($args['status'])) {
                $ticket['status'] = $args['status'];
            }
            if (! empty($args['assignee_id'])) {
                $ticket['assignee_id'] = (int) $args['assignee_id'];
            }
            if (! empty($args['tags']) && is_array($args['tags'])) {
                $ticket['tags'] = $args['tags'];
            }

            $result = $this->service->createTicket(['ticket' => $ticket]);

            $created = $result['ticket'] ?? $result;

            return ToolResult::success([
                'id' => $created['id'] ?? '',
                'subject' => $created['subject'] ?? '',
                'status' => $created['status'] ?? '',
                'priority' => $created['priority'] ?? '',
                'created_at' => $created['created_at'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
