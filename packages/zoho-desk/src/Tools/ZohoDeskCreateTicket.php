<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_create_ticket
 *
 * Create a new support ticket in Zoho Desk.
 */
class ZohoDeskCreateTicket implements Tool
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
        return 'zohodesk_create_ticket';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new support ticket in Zoho Desk. Requires a subject and department ID at minimum.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The ticket subject line.'],
            'departmentId' => ['type' => 'string', 'required' => true, 'description' => 'The department ID to assign the ticket to. Use zohodesk_list_departments to find available departments.'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the issue or request.'],
            'contactId' => ['type' => 'string', 'description' => 'The contact ID to associate with the ticket.'],
            'email' => ['type' => 'string', 'description' => 'Email address of the contact (alternative to contactId).'],
            'priority' => ['type' => 'string', 'description' => 'Ticket priority: "Highest", "High", "Medium", "Low", or "Lowest".'],
            'status' => ['type' => 'string', 'description' => 'Initial status (e.g., "Open"). Defaults to the department default.'],
            'category' => ['type' => 'string', 'description' => 'Ticket category.'],
            'channel' => ['type' => 'string', 'description' => 'Source channel (e.g., "Email", "Phone", "Web", "Chat"). Default: "Web".'],
            'assigneeId' => ['type' => 'string', 'description' => 'Agent ID to assign the ticket to.'],
        ];
    }

    /**
     * Execute the tool — create a ticket in Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            if (empty($args['subject'])) {
                return ToolResult::error('subject is required.');
            }

            if (empty($args['departmentId'])) {
                return ToolResult::error('departmentId is required. Use zohodesk_list_departments to find available departments.');
            }

            $data = array_filter([
                'subject' => $args['subject'],
                'departmentId' => $args['departmentId'],
                'description' => $args['description'] ?? null,
                'contactId' => $args['contactId'] ?? null,
                'email' => $args['email'] ?? null,
                'priority' => $args['priority'] ?? null,
                'status' => $args['status'] ?? null,
                'category' => $args['category'] ?? null,
                'channel' => $args['channel'] ?? 'Web',
                'assigneeId' => $args['assigneeId'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createTicket($data);

            $ticket = $result['data'] ?? $result;

            return ToolResult::success(is_array($ticket) ? $ticket : [$ticket]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
