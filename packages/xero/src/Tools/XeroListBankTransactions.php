<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero bank transactions with optional pagination.
 *
 * Returns spend and receive money transactions from the bank account.
 */
class XeroListBankTransactions implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_list_bank_transactions';
    }

    public function description(): string
    {
        return <<<'MD'
        List Xero bank transactions with optional pagination.
        Returns spend and receive money transactions.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
        ];
    }

    /**
     * List Xero bank transactions.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $params = [];

            if (! empty($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listBankTransactions($params);

            $transactions = array_map(function (array $t) {
                return [
                    'id' => $t['BankTransactionID'] ?? '',
                    'type' => $t['Type'] ?? '',
                    'contact' => $t['Contact']['Name'] ?? '',
                    'total' => $t['Total'] ?? 0,
                    'currency' => $t['CurrencyCode'] ?? '',
                    'date' => $t['Date'] ?? '',
                    'status' => $t['Status'] ?? '',
                    'reference' => $t['Reference'] ?? '',
                ];
            }, $result['BankTransactions'] ?? []);

            return ToolResult::success([
                'bank_transactions' => $transactions,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
