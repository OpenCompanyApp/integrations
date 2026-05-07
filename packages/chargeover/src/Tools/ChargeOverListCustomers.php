<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ChargeOver customers with documented pagination, sorting, and filters.
 */
class ChargeOverListCustomers implements Tool
{
    /**
     * @param  ChargeOverService  $service  The ChargeOver API client.
     */
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_list_customers';
    }

    public function description(): string
    {
        return 'List customers from ChargeOver. Supports limit/offset pagination, where filters, sorting, and optional expansion. Use where expressions such as company:CONTAINS:acme or customer_status_state:EQUALS:a.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of customers to return per page (default: 10, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Record offset for pagination (default: 0).'],
            'where' => ['type' => 'string', 'description' => 'ChargeOver where expression, e.g. superuser_email:EQUALS:person@example.test.'],
            'order' => ['type' => 'string', 'description' => 'Sort expression, e.g. customer_id:DESC.'],
            'expand' => ['type' => 'string', 'description' => 'Optional ChargeOver expand value when supported by the endpoint.'],
            'status' => ['type' => 'string', 'description' => 'Legacy shortcut for customer_status_state; use "a" for active or "i" for inactive.'],
        ];
    }

    /**
     * List customers through the ChargeOver API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, where, order, expand, status).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $where = $args['where'] ?? null;

            if ($where === null && isset($args['status'])) {
                $where = 'customer_status_state:EQUALS:' . $args['status'];
            }

            $result = $this->service->listCustomers(
                $limit,
                $offset,
                $where,
                $args['order'] ?? null,
                $args['expand'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
