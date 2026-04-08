<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoDeskUpdateTicket implements Tool
{
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    public function name(): string
    {
        return 'zohodesk_update_ticket';
    }

    public function description(): string
    {
        return 'Update an existing support ticket in Zoho Desk. Provide the ticket ID and the fields to update (e.g., status, priority, assignee, subject, description).';
    }

    public function parameters(): array
    {
        return [
            'ticketId' => ['type' => 'string', 'required' => true, 'description' => 'The ticket ID to update.'],
            'subject' => ['type' => 'string', 'description' => 'Updated ticket subject.'],
            'description' => ['type' => 'string', 'description' => 'Updated ticket description.'],
            'status' => ['type' => 'string', 'description' => 'New status (e.g., "Open", "On Hold", "Closed", "Escalated").'],
            'priority' => ['type' => 'string', 'description' => 'New priority (e.g., "High", "Medium", "Low").'],
            'assigneeId' => ['type' => 'string', 'description' => 'Agent ID to reassign the ticket to.'],
            'teamId' => ['type' => 'string', 'description' => 'Team ID to reassign the ticket to.'],
            'departmentId' => ['type' => 'string', 'description' => 'Move ticket to a different department.'],
            'channel' => ['type' => 'string', 'description' => 'Updated channel (e.g., "Email", "Phone", "Web").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            if (empty($args['ticketId'])) {
                return ToolResult::error('ticketId is required.');
            }

            $ticketId = $args['ticketId'];
            unset($args['ticketId']);

            $updateData = array_filter($args, fn($value) => $value !== null && $value !== '');

            if (empty($updateData)) {
                return ToolResult::error('No fields provided to update. Provide at least one field (e.g., status, priority).');
            }

            $result = $this->service->updateTicket($ticketId, $updateData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
