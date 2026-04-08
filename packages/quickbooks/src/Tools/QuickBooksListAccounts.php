<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks accounts (chart of accounts) using a query.
 */
class QuickBooksListAccounts implements Tool
{
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_accounts';
    }

    public function description(): string
    {
        return 'List QuickBooks accounts (chart of accounts). Returns a list of accounts with name, type, classification, and balance. Use the limit parameter to control page size.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of accounts to return (default 10, max 1000).'],
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

            $result = $this->service->listAccounts($params);
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
                'max_results' => $queryResponse['maxResults'] ?? ($args['limit'] ?? 10),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
