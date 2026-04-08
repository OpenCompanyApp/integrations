<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List customers from the Shopify store.
 *
 * Supports filtering and pagination.
 */
class ShopifyListCustomers implements Tool
{
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_customers';
    }

    public function description(): string
    {
        return 'List customers from the Shopify store. Supports filtering by email or tag and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of customers per page (default: 50, max: 250).'],
            'email' => ['type' => 'string', 'description' => 'Filter by customer email address.'],
            'tag' => ['type' => 'string', 'description' => 'Filter by customer tag.'],
            'page_info' => ['type' => 'string', 'description' => 'Cursor for pagination (from a previous response).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $params = [];
            $stringParams = ['email', 'tag', 'page_info'];
            $intParams = ['limit'];

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
