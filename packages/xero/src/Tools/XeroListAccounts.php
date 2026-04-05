<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero chart of accounts.
 *
 * Returns all bank accounts and optionally filters by account class type
 * (e.g. ASSET, LIABILITY, EQUITY, REVENUE, EXPENSE).
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
        List the Xero chart of accounts.
        Optionally filter by class type: ASSET, LIABILITY, EQUITY, REVENUE, EXPENSE.
        MD;
    }

    public function parameters(): array
    {
        return [
            'class_type' => ['type' => 'string', 'description' => 'Filter by account class: ASSET, LIABILITY, EQUITY, REVENUE, EXPENSE.'],
        ];
    }

    /**
     * List Xero accounts, optionally filtered by class type.
     *
     * @param  array<string, mixed>  $args  Tool arguments (class_type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $params = [];

            if (! empty($args['class_type'])) {
                $params['Class'] = strtoupper($args['class_type']);
            }

            $result = $this->service->listAccounts($params);

            $accounts = array_map(function (array $a) {
                return [
                    'id' => $a['AccountID'] ?? '',
                    'code' => $a['Code'] ?? '',
                    'name' => $a['Name'] ?? '',
                    'type' => $a['Type'] ?? '',
                    'class' => $a['Class'] ?? '',
                    'status' => $a['Status'] ?? '',
                    'bank_account_number' => $a['BankAccountNumber'] ?? null,
                    'currency' => $a['CurrencyCode'] ?? null,
                ];
            }, $result['Accounts'] ?? []);

            return ToolResult::success([
                'accounts' => $accounts,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
