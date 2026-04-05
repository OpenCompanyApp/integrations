<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoDeskListContacts implements Tool
{
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    public function name(): string
    {
        return 'zohodesk_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts from Zoho Desk. Supports filtering by name, email, and search terms. Returns contact IDs, names, emails, and phone numbers.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'integer', 'description' => 'Starting index for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 25, max: 200).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter contacts by name, email, or phone.'],
            'sortBy' => ['type' => 'string', 'description' => 'Sort field (e.g., "firstName", "createdTime").'],
            'sortOrder' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $params = array_filter($args, fn($value) => $value !== null && $value !== '');
            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
