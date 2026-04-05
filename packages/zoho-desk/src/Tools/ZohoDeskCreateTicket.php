<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoDeskCreateTicket implements Tool
{
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    public function name(): string
    {
        return 'zohodesk_create_ticket';
    }

    public function description(): string
    {
        return 'Create a new support ticket in Zoho Desk. Requires at least a subject and department ID. Optionally include a contact ID, description, priority, and other ticket fields.';
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The ticket subject line.'],
            'departmentId' => ['type' => 'string', 'required' => true, 'description' => 'The department ID to assign the ticket to. Use zohodesk_list_departments to find available departments.'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the issue or request.'],
            'contactId' => ['type' => 'string', 'description' => 'Contact ID to associate with the ticket.'],
            'email' => ['type' => 'string', 'description' => 'Email address of the contact (alternative to contactId).'],
            'priority' => ['type' => 'string', 'description' => 'Ticket priority: "High", "Medium", "Low", or "Lowest".'],
            'status' => ['type' => 'string', 'description' => 'Initial status (default depends on department settings).'],
            'channel' => ['type' => 'string', 'description' => 'Ticket channel (e.g., "Email", "Phone", "Web", "Chat").'],
            'assigneeId' => ['type' => 'string', 'description' => 'Agent ID to assign the ticket to.'],
            'teamId' => ['type' => 'string', 'description' => 'Team ID to assign the ticket to.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            if (empty($args['subject'])) {
                return ToolResult::error('subject is required.');
            }

            if (empty($args['departmentId'])) {
                return ToolResult::error('departmentId is required. Use zohodesk_list_departments to find available departments.');
            }

            $ticketData = array_filter($args, fn($value) => $value !== null && $value !== '');

            $result = $this->service->createTicket($ticketData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
