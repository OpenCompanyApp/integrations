<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Zendesk ticket.
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
        return 'Create a new Zendesk ticket. Requires subject and description. Optionally set priority, type, tags, custom fields, requester, group, and assignee.';
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The subject of the ticket.'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'The initial comment/description of the ticket.'],
            'requester_email' => ['type' => 'string', 'description' => 'Email address of the ticket requester.'],
            'requester_name' => ['type' => 'string', 'description' => 'Name of the ticket requester.'],
            'priority' => ['type' => 'string', 'description' => 'Priority of the ticket (urgent, high, normal, low).'],
            'type' => ['type' => 'string', 'description' => 'Type of the ticket (problem, incident, question, task).'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag strings. Example: ["support", "urgent"].'],
            'custom_fields' => ['type' => 'array', 'description' => 'Array of custom field objects with id and value. Example: [{"id": 123, "value": "foo"}].'],
            'group_id' => ['type' => 'integer', 'description' => 'The ID of the group to assign the ticket to.'],
            'assignee_id' => ['type' => 'integer', 'description' => 'The ID of the agent to assign the ticket to.'],
        ];
    }

    /**
     * Create a Zendesk ticket with subject, description, and optional fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (subject, description, requester_email, requester_name, priority, type, tags, custom_fields, group_id, assignee_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $subject = $args['subject'] ?? '';
        $description = $args['description'] ?? '';

        if (empty($subject)) {
            return ToolResult::error('Subject is required.');
        }

        if (empty($description)) {
            return ToolResult::error('Description is required.');
        }

        try {
            $ticket = [
                'subject' => $subject,
                'comment' => ['body' => $description],
            ];

            if (! empty($args['requester_email'])) {
                $ticket['requester'] = array_filter([
                    'email' => $args['requester_email'],
                    'name' => $args['requester_name'] ?? null,
                ], fn ($v) => $v !== null);
            }

            if (isset($args['priority'])) {
                $ticket['priority'] = $args['priority'];
            }

            if (isset($args['type'])) {
                $ticket['type'] = $args['type'];
            }

            if (isset($args['tags'])) {
                $ticket['tags'] = $args['tags'];
            }

            if (isset($args['custom_fields'])) {
                $ticket['custom_fields'] = $args['custom_fields'];
            }

            if (isset($args['group_id'])) {
                $ticket['group_id'] = (int) $args['group_id'];
            }

            if (isset($args['assignee_id'])) {
                $ticket['assignee_id'] = (int) $args['assignee_id'];
            }

            $result = $this->service->createTicket(['ticket' => $ticket]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
