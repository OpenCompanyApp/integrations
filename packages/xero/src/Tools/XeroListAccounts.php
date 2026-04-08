<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero chart of accounts.
 *
 * Returns accounts with their codes, names, types, and statuses.
 */
class XeroListAccounts implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_list_accounts';
    }

    public function description(): string
    {
        return <<<'MD'
        List Xero chart of accounts.
        Returns account codes, names, types, tax types, and statuses.
        MD;
    }

    public function parameters(): array
    {
        return [
            'where' => ['type' => 'string', 'description' => 'Xero where filter expression (e.g. Type=="BANK").'],
            'order' => ['type' => 'string', 'description' => 'Sort order (e.g. "Code ASC").'],
        ];
    }

    /**
     * List Xero accounts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (where, order)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $params = [];

            if (! empty($args['where'])) {
                $params['where'] = $args['where'];
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }

            $result = $this->service->listAccounts($params);

            $accounts = array_map(function (array $account): array {
                return [
                    'id' => $account['AccountID'] ?? '',
                    'code' => $account['Code'] ?? '',
                    'name' => $account['Name'] ?? '',
                    'type' => $account['Type'] ?? '',
                    'status' => $account['Status'] ?? '',
                    'tax_type' => $account['TaxType'] ?? '',
                    'description' => $account['Description'] ?? '',
                    'class' => $account['Class'] ?? '',
                    'system_account' => $account['SystemAccount'] ?? '',
                    'enable_payments' => $account['EnablePaymentsToAccount'] ?? false,
                ];
            }, $result['Accounts'] ?? []);

            return ToolResult::success([
                'results' => $accounts,
                'count' => count($accounts),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
