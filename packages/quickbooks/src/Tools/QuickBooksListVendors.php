<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks vendors using a query.
 *
 * Runs a SELECT query against the QuickBooks query API to retrieve vendors
 * with optional pagination via STARTPOSITION and MAXRESULTS.
 */
class QuickBooksListVendors implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_vendors';
    }

    public function description(): string
    {
        return <<<'MD'
        List QuickBooks vendors.
        Returns a list of vendors with key fields including name, email, and balance.
        Use the limit parameter to control page size.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of vendors to return (default 10, max 1000).'],
        ];
    }

    /**
     * List QuickBooks vendors with optional limit.
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
            $query = "SELECT * FROM Vendor STARTPOSITION 0 MAXRESULTS {$limit}";

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $vendors = $queryResponse['Vendor'] ?? [];

            $mapped = array_map(function (array $vend) {
                return [
                    'id' => $vend['Id'] ?? '',
                    'sync_token' => $vend['SyncToken'] ?? '',
                    'display_name' => $vend['DisplayName'] ?? '',
                    'first_name' => $vend['GivenName'] ?? '',
                    'last_name' => $vend['FamilyName'] ?? '',
                    'email' => $vend['PrimaryEmailAddr']['Address'] ?? '',
                    'balance' => $vend['Balance'] ?? 0,
                    'active' => $vend['Active'] ?? true,
                ];
            }, $vendors);

            return ToolResult::success([
                'vendors' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'start_position' => $queryResponse['startPosition'] ?? 0,
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
