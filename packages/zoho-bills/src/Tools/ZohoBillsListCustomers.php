<?php

namespace OpenCompany\Integrations\ZohoBills\Tools;

use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoBillsListCustomers implements Tool
{
    public function __construct(
        private ZohoBillsService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_bills_list_customers';
    }

    public function description(): string
    {
        return 'List customers (contacts) from Zoho Bills. Optionally filter by type (customer or vendor). Returns paginated results.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of contacts per page (default: 25, max: 200).'],
            'type' => ['type' => 'string', 'description' => 'Filter by contact type: customer, vendor.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Bills integration is not configured.');
            }

            $result = $this->service->listCustomers(
                page: (int) ($args['page'] ?? 1),
                perPage: (int) ($args['per_page'] ?? 25),
                type: $args['type'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
