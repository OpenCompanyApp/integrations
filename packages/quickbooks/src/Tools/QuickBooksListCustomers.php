<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks customers using a query.
 *
 * Runs a SELECT query against the QuickBooks query API to retrieve customers
 * with optional pagination via STARTPOSITION and MAXRESULTS.
 */
class QuickBooksListCustomers implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_customers';
    }

    public function description(): string
    {
        return <<<'MD'
        List QuickBooks customers.
        Returns a list of customers with key fields. Use the limit parameter to control page size.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of customers to return (default 10, max 1000).'],
        ];
    }

    /**
     * List QuickBooks customers with optional limit.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $query = "SELECT * FROM Customer STARTPOSITION 0 MAXRESULTS {$limit}";

            $result = $this->service->query($query);
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
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
