<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Revolut\RevolutService;

/**
 * Retrieve full bank details for a Revolut account.
 *
 * Returns IBAN, BIC, local account identifiers, supported schemes, and beneficiary details.
 */
class RevolutGetAccountBankDetails implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut Business API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_get_account_bank_details';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve full bank details for a Revolut account.
        Use this after list_accounts or get_account when an agent needs IBAN, BIC/SWIFT, routing, or supported transfer schemes.
        MD;
    }

    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Revolut account UUID.'],
        ];
    }

    /**
     * Retrieve full bank details for a Revolut account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $accountId = (string) ($args['account_id'] ?? '');
            if ($accountId === '') {
                return ToolResult::error('account_id is required.');
            }

            $details = $this->service->getAccountBankDetails($accountId);

            return ToolResult::success([
                'bank_details' => is_array($details) ? $details : [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
