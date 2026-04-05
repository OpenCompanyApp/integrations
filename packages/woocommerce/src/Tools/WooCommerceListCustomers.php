<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_list_customers
 *
 * Lists customers from the WooCommerce store with optional filtering
 * and pagination.
 */
class WooCommerceListCustomers implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_list_customers';
    }

    public function description(): string
    {
        return 'List customers from the WooCommerce store. Supports filtering by email, role, search term, and pagination.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of customers per page (default: 10, max: 100).'],
            'page'     => ['type' => 'integer', 'description' => 'Current page number (1-based).'],
            'search'   => ['type' => 'string',  'description' => 'Search by customer name, email, or username.'],
            'email'    => ['type' => 'string',  'description' => 'Filter by email address.'],
            'role'     => ['type' => 'string',  'description' => 'Filter by user role (default: all).'],
            'orderby'  => ['type' => 'string',  'description' => 'Sort by: id, include, name, registered_date.'],
            'order'    => ['type' => 'string',  'description' => 'Sort direction: asc or desc (default: desc).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $params = array_filter([
                'per_page' => $args['per_page'] ?? null,
                'page'     => $args['page'] ?? null,
                'search'   => $args['search'] ?? null,
                'email'    => $args['email'] ?? null,
                'role'     => $args['role'] ?? null,
                'orderby'  => $args['orderby'] ?? null,
                'order'    => $args['order'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listCustomers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
