<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new Wise transfer.
 *
 * Initiates a money transfer between accounts. Requires source account,
 * target account, and amount. Optionally includes a payment reference.
 */
class WiseCreateTransfer implements Tool
{
    /**
     * Create a new WiseCreateTransfer instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_create_transfer';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Create a new money transfer on Wise.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'source_account' => ['type' => 'integer', 'description' => 'Source account ID (borderless account balance to debit from).', 'required' => true],
            'target_account' => ['type' => 'integer', 'description' => 'Target account ID (recipient account to credit).', 'required' => true],
            'amount' => ['type' => 'number', 'description' => 'Amount to transfer in the source currency.', 'required' => true],
            'reference' => ['type' => 'string', 'description' => 'Payment reference or description for the transfer.'],
        ];
    }

    /**
     * Execute the tool — create a new transfer.
     *
     * @param array $args Tool arguments containing source_account, target_account, amount, and optional reference.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $sourceAccount = $args['source_account'] ?? null;
            $targetAccount = $args['target_account'] ?? null;
            $amount = $args['amount'] ?? null;

            if (empty($sourceAccount)) {
                return ToolResult::error('Parameter "source_account" is required.');
            }
            if (empty($targetAccount)) {
                return ToolResult::error('Parameter "target_account" is required.');
            }
            if (empty($amount)) {
                return ToolResult::error('Parameter "amount" is required.');
            }

            $data = [
                'sourceAccount' => $sourceAccount,
                'targetAccount' => $targetAccount,
                'amount' => (float) $amount,
                'details' => new \stdClass(),
            ];

            if (isset($args['reference'])) {
                $data['details']->reference = $args['reference'];
            }

            $transfer = $this->service->createTransfer($data);

            return ToolResult::success($transfer);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
