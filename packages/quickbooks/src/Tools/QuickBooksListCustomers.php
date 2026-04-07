<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks customers using a query.
 */
class QuickBooksListCustomers implements Tool
{
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_customers';
    }

    public function description(): string
    {
        return 'List QuickBooks customers. Returns a list of customers with key fields. Use the limit parameter to control page size.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of customers to return (default 10, max 1000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listCustomers($params);
            $queryResponse = $result['QueryResponse'] ?? [];
            $customers = $queryResponse['Customer'] ?? [];

            $mapped = array_map(function (array $cust) {
                return [
                    'id' => $cust['Id'] ?? '',
                    'sync_token' => $cust['SyncToken'] ?? '',
                    'display_name' => $cust['DisplayName'] ?? '',
                    'first_name' => $cust['GivenName'] ?? '',
                    'last_name' => $cust['FamilyName'] ?? '',
                    'email' => $cust['PrimaryEmailAddr']['Address'] ?? '',
                    'balance' => $cust['Balance'] ?? 0,
                    'active' => $cust['Active'] ?? true,
                ];
            }, $customers);

            return ToolResult::success([
                'customers' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'start_position' => $queryResponse['startPosition'] ?? 0,
                'max_results' => $queryResponse['maxResults'] ?? ($args['limit'] ?? 10),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
