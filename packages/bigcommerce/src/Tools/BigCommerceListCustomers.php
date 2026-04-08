<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List customers from the BigCommerce store.
 *
 * Supports filtering and pagination.
 */
class BigCommerceListCustomers implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_list_customers';
    }

    public function description(): string
    {
        return 'List customers from the BigCommerce store. Supports filtering by name or email and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of customers per page (default: 50, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'name' => ['type' => 'string', 'description' => 'Filter by customer name.'],
            'email' => ['type' => 'string', 'description' => 'Filter by email address.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g., "name", "email", "date_created", "id").'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $params = [];
            $stringParams = ['name', 'email', 'sort', 'direction'];
            $intParams = ['limit', 'page'];

            foreach ($stringParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            foreach ($intParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = (int) $args[$key];
                }
            }

            $result = $this->service->listCustomers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
