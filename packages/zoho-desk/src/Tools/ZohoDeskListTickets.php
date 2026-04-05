<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoDeskListTickets implements Tool
{
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    public function name(): string
    {
        return 'zohodesk_list_tickets';
    }

    public function description(): string
    {
        return 'List support tickets from Zoho Desk. Supports filtering by department, status, priority, and other criteria. Returns ticket IDs, subjects, statuses, and basic details.';
    }

    public function parameters(): array
    {
        return [
            'departmentId' => ['type' => 'string', 'description' => 'Filter by department ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status (e.g., "Open", "On Hold", "Closed", "Escalated").'],
            'priority' => ['type' => 'string', 'description' => 'Filter by priority (e.g., "High", "Medium", "Low").'],
            'from' => ['type' => 'integer', 'description' => 'Starting index for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tickets to return (default: 25, max: 200).'],
            'sortBy' => ['type' => 'string', 'description' => 'Sort field (e.g., "createdTime", "subject", "priority").'],
            'sortOrder' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter tickets by subject or description.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $params = array_filter($args, fn($value) => $value !== null && $value !== '');
            $result = $this->service->listTickets($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
