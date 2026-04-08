<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChartMogulListCustomers implements Tool
{
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_list_customers';
    }

    public function description(): string
    {
        return 'List customers from ChartMogul. Supports filtering by status or email and pagination. Returns customer details including UUID, name, email, company, and status.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'page' => ['type' => 'integer', 'description' => 'Page number, starting from 1 (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by customer status. Common values: "Active", "Cancelled", "Future".'],
            'email' => ['type' => 'string', 'description' => 'Filter by customer email address.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? null;
            $email = $args['email'] ?? null;

            $result = $this->service->listCustomers($perPage, $page, $status, $email);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
