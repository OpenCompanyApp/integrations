<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks accounts using a query.
 *
 * Runs a SELECT query against the QuickBooks query API to retrieve accounts
 * (chart of accounts) with optional pagination.
 */
class QuickBooksListAccounts implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_accounts';
    }

    public function description(): string
    {
        return <<<'MD'
        List QuickBooks accounts (chart of accounts).
        Returns a list of accounts with key fields including name, type, and balance.
        Use the limit parameter to control page size.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of accounts to return (default 10, max 1000).'],
        ];
    }

    /**
     * List QuickBooks accounts with optional limit.
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
            $query = "SELECT * FROM Account STARTPOSITION 0 MAXRESULTS {$limit}";

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $accounts = $queryResponse['Account'] ?? [];

            $mapped = array_map(function (array $acct) {
                return [
                    'id' => $acct['Id'] ?? '',
                    'sync_token' => $acct['SyncToken'] ?? '',
                    'name' => $acct['Name'] ?? '',
                    'fully_qualified_name' => $acct['FullyQualifiedName'] ?? '',
                    'account_type' => $acct['AccountType'] ?? '',
                    'account_sub_type' => $acct['AccountSubType'] ?? '',
                    'classification' => $acct['Classification'] ?? '',
                    'current_balance' => $acct['CurrentBalance'] ?? 0,
                    'active' => $acct['Active'] ?? true,
                ];
            }, $accounts);

            return ToolResult::success([
                'accounts' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'start_position' => $queryResponse['startPosition'] ?? 0,
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
