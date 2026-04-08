<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoDeskListDepartments implements Tool
{
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    public function name(): string
    {
        return 'zohodesk_list_departments';
    }

    public function description(): string
    {
        return 'List all departments configured in Zoho Desk. Returns department IDs, names, descriptions, and visibility settings. Department IDs are needed when creating tickets.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'integer', 'description' => 'Starting index for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of departments to return (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $params = array_filter($args, fn($value) => $value !== null && $value !== '');
            $result = $this->service->listDepartments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
