<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Revolut business accounts.
 *
 * Returns account IDs, names, balances, and currency information.
 */
class RevolutListAccounts implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_list_accounts';
    }

    public function description(): string
    {
        return <<<'MD'
        List all Revolut business accounts.
        Returns account IDs, names, balances, and currency information.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Revolut business accounts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $result = $this->service->listAccounts();

            $accounts = array_map(function (array $a) {
                return [
                    'id' => $a['id'] ?? '',
                    'name' => $a['name'] ?? '',
                    'currency' => $a['currency'] ?? '',
                    'balance' => $a['balance'] ?? 0,
                    'state' => $a['state'] ?? '',
                    'type' => $a['type'] ?? '',
                ];
            }, is_array($result) ? $result : []);

            return ToolResult::success([
                'accounts' => $accounts,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
