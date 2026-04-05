<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Shopify customers with optional filters and pagination.
 */
class ShopifyListCustomers implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_customers';
    }

    public function description(): string
    {
        return <<<'MD'
        List Shopify customers with optional filters.
        Supports filtering by email and tag.
        Use limit to control page size (max 250) and page_info for cursor-based pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of customers to return (max 250).'],
            'email' => ['type' => 'string', 'description' => 'Filter by customer email address.'],
            'tag' => ['type' => 'string', 'description' => 'Filter by customer tag.'],
            'page_info' => ['type' => 'string', 'description' => 'Cursor for pagination (from previous response).'],
        ];
    }

    /**
     * List customers from Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['email'])) {
                $params['email'] = $args['email'];
            }
            if (isset($args['tag'])) {
                $params['tag'] = $args['tag'];
            }
            if (isset($args['page_info'])) {
                $params['page_info'] = $args['page_info'];
            }

            $result = $this->service->listCustomers($params);
            $customers = $result['customers'] ?? [];

            return ToolResult::success([
                'customers' => $customers,
                'count' => count($customers),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
