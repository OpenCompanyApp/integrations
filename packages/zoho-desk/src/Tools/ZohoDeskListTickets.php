<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_list_tickets
 *
 * List support tickets from Zoho Desk with optional filtering and pagination.
 */
class ZohoDeskListTickets implements Tool
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
        return 'zohodesk_list_tickets';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List support tickets from Zoho Desk. Supports filtering by department, status, priority, and pagination.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'departmentId' => ['type' => 'string', 'description' => 'Filter by department ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by ticket status (e.g., "Open", "On Hold", "Closed").'],
            'priority' => ['type' => 'string', 'description' => 'Filter by priority (e.g., "High", "Medium", "Low").'],
            'from' => ['type' => 'integer', 'description' => 'Pagination offset (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'sortBy' => ['type' => 'string', 'description' => 'Sort field (e.g., "createdTime", "modifiedTime", "ticketNumber").'],
            'sortOrder' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
            'contactId' => ['type' => 'string', 'description' => 'Filter tickets by contact ID.'],
            'assigneeId' => ['type' => 'string', 'description' => 'Filter tickets by assignee (agent) ID.'],
        ];
    }

    /**
     * Execute the tool — list tickets from Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the parameter schema.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $params = array_filter([
                'departmentId' => $args['departmentId'] ?? null,
                'status' => $args['status'] ?? null,
                'priority' => $args['priority'] ?? null,
                'from' => $args['from'] ?? null,
                'limit' => $args['limit'] ?? null,
                'sortBy' => $args['sortBy'] ?? null,
                'sortOrder' => $args['sortOrder'] ?? null,
                'contactId' => $args['contactId'] ?? null,
                'assigneeId' => $args['assigneeId'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listTickets($params);

            $tickets = $result['data'] ?? $result['tickets'] ?? $result;

            return ToolResult::success(is_array($tickets) ? $tickets : [$tickets]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
