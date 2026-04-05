<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks accounts using a SQL-like query.
 *
 * Supports filtering by account type and pagination via limit.
 * Returns an array of account summaries.
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
        List QuickBooks accounts using a SQL-like query.
        Supports filtering by account type (e.g., "Asset", "Liability", "Income", "Expense") and pagination via limit.
        MD;
    }

    public function parameters(): array
    {
        return [
            'account_type' => ['type' => 'string', 'description' => 'Filter by account type (e.g., "Asset", "Liability", "Income", "Expense", "Equity").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of accounts to return (1–1000, default 100).'],
        ];
    }

    /**
     * List QuickBooks accounts with optional type filter and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_type, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $accountType = $args['account_type'] ?? '';

            if (! empty($accountType)) {
                $escapedType = addslashes($accountType);
                $query = "SELECT * FROM Account WHERE AccountType = '{$escapedType}' MAXRESULTS {$limit}";
            } else {
                $query = "SELECT * FROM Account MAXRESULTS {$limit}";
            }

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $accounts = $queryResponse['Account'] ?? [];

            $mapped = array_map(function (array $a) {
                return [
                    'id' => $a['Id'] ?? '',
                    'name' => $a['Name'] ?? '',
                    'account_type' => $a['AccountType'] ?? null,
                    'account_sub_type' => $a['AccountSubType'] ?? null,
                    'classification' => $a['Classification'] ?? null,
                    'current_balance' => $a['CurrentBalance'] ?? 0,
                    'currency' => $a['CurrencyRef']['value'] ?? null,
                    'active' => $a['Active'] ?? true,
                ];
            }, $accounts);

            return ToolResult::success([
                'accounts' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
