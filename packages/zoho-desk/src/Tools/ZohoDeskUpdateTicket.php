<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_update_ticket
 *
 * Update an existing support ticket in Zoho Desk.
 */
class ZohoDeskUpdateTicket implements Tool
{
    /**
     * @param  ZohoDeskService  $service  The Zoho Desk API service instance.
     */
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'zohodesk_update_ticket';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Update an existing Zoho Desk support ticket. Provide the ticket ID and the fields to change (e.g., status, priority, assignee, subject).';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ticketId' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Desk ticket ID to update.'],
            'subject' => ['type' => 'string', 'description' => 'Updated ticket subject.'],
            'description' => ['type' => 'string', 'description' => 'Updated ticket description.'],
            'status' => ['type' => 'string', 'description' => 'New status (e.g., "Open", "On Hold", "Closed", "Resolved").'],
            'priority' => ['type' => 'string', 'description' => 'New priority: "Highest", "High", "Medium", "Low", or "Lowest".'],
            'assigneeId' => ['type' => 'string', 'description' => 'Agent ID to reassign the ticket to.'],
            'departmentId' => ['type' => 'string', 'description' => 'Move ticket to a different department.'],
            'category' => ['type' => 'string', 'description' => 'Updated ticket category.'],
            'channel' => ['type' => 'string', 'description' => 'Updated source channel.'],
            'comment' => ['type' => 'string', 'description' => 'Add a comment to the ticket along with the update.'],
        ];
    }

    /**
     * Execute the tool — update a ticket in Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            if (empty($args['ticketId'])) {
                return ToolResult::error('ticketId is required.');
            }

            $ticketId = $args['ticketId'];
            unset($args['ticketId']);

            $data = array_filter($args, fn ($value) => $value !== null);

            if (empty($data)) {
                return ToolResult::error('At least one field to update must be provided.');
            }

            $result = $this->service->updateTicket($ticketId, $data);

            $ticket = $result['data'] ?? $result;

            return ToolResult::success(is_array($ticket) ? $ticket : [$ticket]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
