<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Zendesk ticket.
 */
class ZendeskUpdateTicket implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_update_ticket';
    }

    public function description(): string
    {
        return 'Update an existing Zendesk ticket. Can modify subject, priority, status, type, tags, custom fields, assignee, and group.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to update.'],
            'subject' => ['type' => 'string', 'description' => 'Updated subject of the ticket.'],
            'priority' => ['type' => 'string', 'description' => 'Updated priority (urgent, high, normal, low).'],
            'status' => ['type' => 'string', 'description' => 'Updated status (new, open, pending, hold, solved, closed).'],
            'type' => ['type' => 'string', 'description' => 'Updated type (problem, incident, question, task).'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag strings to replace existing tags.'],
            'custom_fields' => ['type' => 'array', 'description' => 'Array of custom field objects with id and value. Example: [{"id": 123, "value": "foo"}].'],
            'assignee_id' => ['type' => 'integer', 'description' => 'The ID of the agent to assign the ticket to.'],
            'group_id' => ['type' => 'integer', 'description' => 'The ID of the group to assign the ticket to.'],
        ];
    }

    /**
     * Update a Zendesk ticket with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, subject, priority, status, type, tags, custom_fields, assignee_id, group_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $id = $args['id'] ?? '';

        if (empty($id)) {
            return ToolResult::error('Ticket ID is required.');
        }

        try {
            $ticket = [];

            if (isset($args['subject'])) {
                $ticket['subject'] = $args['subject'];
            }

            if (isset($args['priority'])) {
                $ticket['priority'] = $args['priority'];
            }

            if (isset($args['status'])) {
                $ticket['status'] = $args['status'];
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

            if (isset($args['assignee_id'])) {
                $ticket['assignee_id'] = (int) $args['assignee_id'];
            }

            if (isset($args['group_id'])) {
                $ticket['group_id'] = (int) $args['group_id'];
            }

            $result = $this->service->updateTicket((int) $id, ['ticket' => $ticket]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
